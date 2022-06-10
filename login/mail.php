<?php
include "../register/classes/class.phpmailer.php";

$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "mail.sutrasalon.xyz"; //host masing2 provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "system@sutrasalon.xyz"; //user email
$mail->Password = "sutrasalon123!"; //password email 
$mail->SetFrom("system@sutrasalon.xyz","System | Sutra Salon"); //set email pengirim
$mail->addReplyTo("system@sutrasalon.xyz", "noreply"); //Set an alternative reply-to address
$mail->Subject = "Reset Password"; //subyek email
$mail->AddAddress($data['username'], $data['nama_depan']." ".$data['nama_belakang']);  //tujuan email
$mail->MsgHTML("<!DOCTYPE html>
<html lang='en'>
<body style='margin:0px; background: #f8f8f8;'>
    <div width='100%'
        style='background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;'>
        <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
            <div style='padding: 40px; background: #fff;'>
                <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                    <tbody>
                        <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                            <tbody>
                                <tr>
                                    <td style='vertical-align: top;' align='center'>
                                        <img src='<?= $link?>img/logo(bg_terang).png' alt='Sutra Salon'
                                            style='border:none' width='13%'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr width='100%' size='5' color='black'
                            style='margin-bottom: 0 !important; margin-top: 20px !important;'>
                        <hr width='100%' size='1' color='black'
                            style='margin-top: 3px !important; margin-bottom: 20px !important;'>
                        <tr>
                            <td style='border-bottom:1px solid #f6f6f6;'>
                                <h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;'>Dear
                                    ".$data['nama_depan']." ".$data['nama_belakang']."</h1>
                                <p style='margin-top:0px; color:#bbbbbb;'>Email pemberitahuan telah berhasil melakukan reset password pada Akun Anda, mohon untuk
                                    tidak membalas.</p>
                            </td>
                        </tr>
                        <hr color='aliceblue' style='color: aliceblue;'>
                        <tr>
                            <td style='padding:10px 0 30px 0;'>
                                <p>
                                    <h3>Hay, ".$data['nama_depan']." ".$data['nama_belakang']."</h3>
                                </p>
                                <p>
                                    Anda telah <b>Berhasil</b> mereset password Akun Anda<br>
                                    Password Anda Sekarang sebagai berikut :
                                </p>
                                <h1 style='text-align: center;'><strong>".$random."</strong></h1>
                                <p style='font-size:12px;color:red;'>*Jangan lupa ganti kembali password pada profile Akun Anda</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style='text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px'>
                <p>Copyright &copy 2021 Sutra Salon dibuat oleh <b>Angker Group 2020</b></p>
            </div>
        </div>
    </div>
</body>
</html>");
if($mail->Send()){
    setcookie('berhasil','Password Berhasil di Reset, Password Anda dapat dilihat di email.<br> <span style="font-size:10px;color:red;">*Silahkan ganti password Anda di pengaturan Akun nanti</span>',time()+2);
}else{
    setcookie('gagal','Password gagal direset',time()+2);
} 

?>