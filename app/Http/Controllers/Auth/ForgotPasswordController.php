<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\User;
use Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $rules_prf = array(            
            'email'     => 'required|email|check',
        );        

        $messages = array( 
            'email.check' => 'Email not match'
        );
            
        $validate = Validator::make($request->all(), $rules_prf, $messages);
            
        if ($validate->fails()) {                            
            return back()->withInput()->withErrors($validate);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );        

        $tokens = $this->broker()->createToken(
            User::where('email',$request->only('email')) -> first()
        );

        User::where('email', $request->email)
          ->update(['remember_token' => $tokens]);

        $data = array(
            'from'      => \Config::get('app.from_email'),
            'token'     => url(\Request::root().route('password.reset', $tokens, false)),            
            'to'        => $request->email
        );        

        \Mail::send('email.reset', $data, function ($message) use ($data) {
            $message->subject('Reset Password');
            $message->from($data['from'], 'Konseen');
            $message->to($data['to']);
        });

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);

    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    protected function sendResetLinkResponse($response)
    {
        //return back()->with('status', trans($response));
        $link = str_replace(url('/'), '', url()->previous());
        if($link == '/password/reset'){
            return redirect('password/result')->with('status', trans($response));
        }else{
            return redirect('result')->with('status', trans($response));
        }        
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    public function broker()
    {
        return Password::broker();
    }

    public function result()
    {
        return view('result');
    }

    public function resulte()
    {
        return view('resulte');
    }

    public function reset()
    {
        return view('forgot');
    }
}
