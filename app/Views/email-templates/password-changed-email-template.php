 <p>Dear Mr/Ms. <b><?= $mail_data['user']->Last_Name ?></b>:</p>
 <br>
 <p>
    Your password on AgriSmart systam was changed successfully. Here are your new login credentials:

    <br><br>

    <b>Login ID: </b> <?= $mail_data['user']->Email ?>
    <br>
    <b>Password: </b> <?= $mail_data['new_password'] ?>
 </p>

 <br><br>

 Please keep your credentials confidential. Your email and password are your own credentials and you should never share it with anybody else.

 <p>AgriSmart will not be liable for any misuse of your email or password</p>

 <br>
 <hr>
 <p>This email was automatically sent by AgriSmart system. Do not reply to it.</p>