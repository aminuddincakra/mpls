<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>KONSEEN.ID - Reset Password</title>
    </head>
    <body style="margin: 0;">
        <table cellpadding="0" cellspacing="0" border="0" width="600" style="font-size: 16px; line-height: 30px; color: #444444; font-family: \'proximanova-regular\', sans-serif; margin: 0 auto; background: #fdfdff;">
            <tbody>
                <tr>
                    <td width="100%" style="vertical-align: top; padding: 60px 30px;" align="left">
                        <a href="#" style="display: block; font-size: 30px; line-height: 45px; margin: 0 0 50px; color: #333; font-weight: bold; text-decoration: none; ">KONSEEN.ID</a>
                        <h1 style="font-size: 21px; line-height: 25px; margin: 0 0 20px;">Reset Password</h1>
                        <p style="width: 450px; margin: 0 0 30px;">Anda melakukan permintaan untuk mengganti password terhadap password lama anda. Silahkan klik link dibawah untuk melakukan pergantian password.</p>
                        <a href="{{ $token }}?code={{ base64_encode($to) }}" target="_blank" style="background: #5865C1; color: #fff; padding: 17px 0; border: 1px solid #4F5DBA; border-radius: 2px; font-size: 18px; text-decoration: none; display: block; width: 310px; text-align: center; margin-bottom: 60px">Reset password</a>
                        <p style="width: 450px; margin: 0 0 30px;">Jika anda tidak melakukan, abaikan email ini</p> 
                    </td>
                </tr>
                <tr>
                    <td width="100%" style="vertical-align: bottom; padding: 50px 30px; font-size: 12px; color: #777;" align="left">Email ini dikirim oleh KONSEEN.ID.</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>