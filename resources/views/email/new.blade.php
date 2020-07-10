<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>KONSEEN.ID - Selamat datang</title>
    </head>
    <body style="margin: 0;">
        <table cellpadding="0" cellspacing="0" border="0" width="600" style="font-size: 16px; line-height: 30px; color: #444444; font-family: \'proximanova-regular\', sans-serif; margin: 0 auto; background: #fdfdff;">
            <tbody>
                <tr>
                    <td width="100%" style="vertical-align: top; padding: 60px 30px;" align="left">
                        <a href="#" style="display: block; font-size: 30px; line-height: 45px; margin: 0 0 50px; color: #333; font-weight: bold; text-decoration: none; ">KONSEEN.ID</a>
                        <h1 style="font-size: 21px; line-height: 25px; margin: 0 0 20px;">Pendaftaran Berhasil</h1>
                        <p style="width: 450px; margin: 0 0 30px;">Halo {{ $nama }},<br/>Email : {{ $to }}<br>Password : {{ $password }}<br>Terima kasih telah melakukan pendaftaran.</p>
                        <p style="width: 450px; margin: 0 0 30px;">Jika Anda memiliki pertanyaan atau komentar, jangan ragu untuk mengirimkan pesan kepada kami di <a href="mailto:info@konseen.id">info@konseen.id</a><br/>
                        </p> 
                        <p style="width: 450px; margin: 0 0 30px;">Verifikasi Email anda dengan link di bawah ini<br/>
                            <a href="{{ url('/activate?token='.$link) }}" target="_blank">{{ url('/activate?token='.$link) }}</a>
                        </p> 
                    </td>
                </tr>
                <tr>
                    <td width="100%" style="vertical-align: bottom; padding: 50px 30px; font-size: 12px; color: #777;" align="left">Email ini dikirim oleh KONSEEN.ID.</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>