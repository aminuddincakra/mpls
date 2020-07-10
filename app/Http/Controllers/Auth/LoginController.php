<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Models\Perm;
use App\Models\Update;
use App\Models\Log;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $rules_prf = array(
            'email'         => 'required',
            'password'      => 'required'
        );
                    
        $validate = Validator::make($request->all(), $rules_prf);
                    
        if ($validate->fails()) {                
            $messages = $validate->messages();
            return back()->withInput()->withErrors($validate);
        }

        $credentials = $request->only('email', 'password');
        if(\Auth::attempt($credentials)){ 
            if (\Auth::user()->activate == 0) {
                \Auth::logout();
                $validate->after(function ($validate) {
                    $validate->errors()->add('email', 'Akun anda belum diaktifasi');
                });
            }elseif (\Auth::user()->activate == 2) {
                \Auth::logout();
                $validate->after(function ($validate) {
                    $validate->errors()->add('email', 'Akun anda di bekukan');
                });
            }else{
                /*$commands = array(
                    'echo $PWD',
                    'whoami',
                    'git status',
                    'git fetch origin',
                    'git diff --name-only master origin/master'
                );
                // Run the commands for output
                $output = '';
                foreach($commands AS $command){           
                    $tmp = shell_exec($command);
                    if($command == 'git diff --name-only master origin/master'){
                        //$tmp = shell_exec($command);
                        //testing aja
                        //$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
                        $output .= htmlentities(trim($tmp)) . "<br>";
                    }
                }

                //ternyata berhasil
                if(strlen($output) > 4){
                    $upt = new Update;
                    $upt->tanggal = date('Y-m-d');
                    $upt->status = 0;
                    $upt->save();

                    //testing komen
                }*/

                if(\Session::has('redirects')){
                    $redir = \Session::has('redirects');
                    $redirect = (array_key_exists('0', $redir))?$redir['0']:'/dashboard';
                    return redirect($redirect);
                }else{
                    Log::insert(['user_id' => \Auth::user()->id, 'text' => 'Login', 'created_at' => date('Y-m-d H:i:s')]);
                    return redirect('/dashboard');
                }
            }
        }else{
            $validate->after(function ($validate) {
                $validate->errors()->add('email', 'Email atau password anda salah');
            });
        }

        if ($validate->fails()) {                
            $messages = $validate->messages();
            return back()->withInput()->withErrors($validate);
        }
    }

    public function register(Request $request)
    {        
        $rules_prf = array(
            'email_reg'         => 'required|cek'
        );
                
        $validate = Validator::make($request->all(), $rules_prf);
                
        if ($validate->fails()) {                
            $messages = $validate->messages();
            return back()->withInput()->withErrors($validate);
        }

        $token = str_random(30);        
        $password = self::set_password();
        $user = new User;
        $user->name = $request->email_reg;
        $user->email = $request->email_reg;
        $user->password = \Hash::make($password);
        $user->perm_id = 7;
        $user->token = $token;
        $user->save();

        $link = $request->email_reg.' dan '.$token;
        $link = base64_encode($link);

        $data = array(
            'from'      => \Config::get('app.from_email'),
            'to'        => $request->email_reg,
            'password'  => $password,
            'nama'      => $request->email_reg,
            'title'     => 'MITRA',
            'link'      => $link
        );        

        \Mail::send('email.new', $data, function ($message) use ($data) {
            $message->subject('Register New User');
            $message->from($data['from'], 'Konseen');
            $message->to($data['to']);
        });

        flash($request->email_reg.' successfully created, Please check your email for account details.')->success();
        return redirect('/register');
    }

    private function set_password()
    {
        $length = 10;

        $randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"), 0, $length);
        return $randomletter;
    }

    public function activate(Request $request)
    {
        $token = base64_decode($request->token);
        $pecah = explode(" dan ", $token);
        $email = (array_key_exists('0', $pecah))?$pecah['0']:'';
        $token = (array_key_exists('1', $pecah))?$pecah['1']:'';

        $rules_prf = array(
            '$token'         => 'required',
        );

        $validate = Validator::make($request->all(), $rules_prf);
        if(count(User::where('email', $email)->where('token', $token)->get()) > 0){
            User::where('email', $email)
                ->update(['activate' => 1]);

            return redirect('login');
        }else{
            $validate->after(function ($validate) {
                $validate->errors()->add('email', 'Activate failed');
            });

            if ($validate->fails()) {                
                $messages = $validate->messages();
                return redirect('login')->withInput()->withErrors($validate);
            }
        }    
    }

    public function logout(Request $request)
    {
        Log::insert(['user_id' => \Auth::user()->id, 'text' => 'Logout', 'created_at' => date('Y-m-d H:i:s')]);

        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        if($request->redrrt == 'cbt'){
            return redirect('cbt');
        }elseif($request->redrrt == 'dashboard'){
            return redirect()->route('login');
        }else{
            return redirect('siswa');
        }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $cek = User::where('email', $user->email)->whereNull('provider')->first();
        if(empty($cek)){
            $authUser = $this->findOrCreateUser($user, $provider);
            \Auth::login($authUser, true);
            $url = '/dashboard';
            if(\Session::has('redirects')){
                $redir = \Session::get('redirects');
                if(array_key_exists('0', $redir)){
                    return redirect($redir['0']);
                }else{
                    return redirect($url);
                }
            }else{
                return redirect($url);
            }
        }else{
            flash($user->email.' sudah digunakan.')->error();

            return redirect('/');
        }
    }
    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }else{
            $data = User::create([
                'name'          => $user->name,
                'email'         => !empty($user->email)? $user->email : '' ,
                'password'      => md5($user->name),
                'provider'      => $provider,
                'perm_id'       => 7,
                'provider_id'   => $user->id
            ]);
            return $data;
        }
    }
}
