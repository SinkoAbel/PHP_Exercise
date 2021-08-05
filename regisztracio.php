
<br>
<p class="container">Regisztráció felüet. Kérjük adja meg adatait!</p>

<?php

    if(isset($_POST['reg_gomb']))
    {
        $teljes_nev = mysqli_real_escape_string($l, $_POST['teljes_nev']);
        $email = mysqli_real_escape_string($l, $_POST['email']);
        $jelszo = mysqli_real_escape_string($l, $_POST['jelszo']);
        $jelszo2 = mysqli_real_escape_string($l, $_POST['jelszo2']);
        $aszf = mysqli_real_escape_string($l, $_POST['aszf']);


        $lekerdezes = mysqli_query($l, "SELECT * FROM `felhasznalo` WHERE `email` = '".$email."' ");
        $darabszam = mysqli_num_rows($lekerdezes);

        if ($darabszam == 0)
        {
            if ($aszf == 'igen')
            {
                if ($jelszo == $jelszo2)
                {

                    $kodolt_jelszo = hash('sha256', $jelszo);

                    mysqli_query($l, "INSERT INTO `felhasznalo` SET
                        `id` = NULL,
                        `teljes_nev` = '".$teljes_nev."',
                        `email` = '".$email."',
                        `jelszo` = '".$kodolt_jelszo."',
                        `visszaigazolva` = 'nem',
                        `regisztracio` = '".date('Y-m-d H:i:s')."'
                        ");


                    //visszaigazoló email küldése
                    include ('class.phpmailer.php');

                    $szoveg = ' Kedves '.$teljes_nev.'!
                    <br><br>
                    Köszönjük, hogy regisztrált!<br>
                    A regisztráció megerősítéséhez kérjük kattintson a linkre:
                    <a href="localhost/SinkoAbel_teszt/index.php?oldal=visszaigazolas&email='.base64_encode($email).'">localhost/SinkoAbel_teszt/index.php?oldal=visszaigazolas&email='.base64_encode($email).'</a>

                    <br><br>
                    Üdvözlettel: <br>
                    Tóth és Társa Kft. ';


                    //Create a new PHPMailer instance
                    $mail = new PHPMailer();
                    //Set who the message is to be sent from
                    $mail->SetFrom('teszt@valami.hu', 'Auto-alkatresz Kft.');
                    //Set an alternative reply-to address
                    $mail->AddReplyTo('teszt@valami.hu', 'Auto-alkatresz Kft.');
                    //Set who the message is to be sent to
                    $mail->AddAddress($email, $teljes_nev);
                    //Set the subject line
                    $mail->Subject = "Regisztracio";
                    //Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
                    $mail->MsgHTML($szoveg, dirname(__FILE__));
                    //Replace the plain text body with one created manually
                    $mail->AltBody = 'This is a plain-text message body';
                    //Attach an image file
                    //$mail->AddAttachment('images/phpmailer.png');

                    //Send the message, check for errors
                    if(!$mail->Send())
                    {
                        print 'E-mail küldési hiba: ' . $mail->ErrorInfo;
                    }
                    else
                    {
                        print '<p class="bg-success text-white">Sikeres regisztráció!</p>';
                    }

                }

                else
                {
                    print '<p class="bg-danger text-white">A két jelszó nem egyezik!</p>';
                }
            }
        }
        else
        {
            print '<p class="bg-danger text-white fw-bold">A megadott emailcím már használatban van. Kérjük használjon másikat.</p>';
        }
    }



?>





<?php

    print '
    <div class="container">
        <form method="post">
            <input type="text" name="teljes_nev" placeholder="Teljes név" class="form-control" required value="'.$teljes_nev.'">
            
            <br>
            <input type="email" name="email" placeholder="E-mail cím" class="form-control" required value="'.$email.'">
            
            <br>
            <input type="password" name="jelszo" placeholder="Jelszó" class="form-control" required>
            
            <br>
            <input type="password" name="jelszo2" placeholder="Jelszó mégegyszer" class="form-control" required>
        
            <br>
            <input type="checkbox" name="aszf" value="igen" required> Az <a href="#">ÁSZF</a> és az <a href="#">Adatkezelési tájékoztató</a> tartalmát elolvastam és elfogadom.
       
            <br>
            <input type="submit" name="reg_gomb" value="Regisztrálok" class="btn btn-primary">
        </form>
    </div>';

?>




























