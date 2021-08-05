<?php

    if ($_GET['email'] != '')
    {
        $kodolt_email = $_GET['email'];
        $email = base64_decode($kodolt_email);

        $email = mysqli_real_escape_string($l, $email);

        mysqli_query($l, "UPDATE `felhasznalo` SET `visszaigazolva`='igen' WHERE `email` = '".$email."' ");

        print '<p class="bg-succes text-white"><a href="index.php?oldal=bejelentkezes">Sikeres visszaigazolás, kérjük jelentkezzen be itt!</a></p>';

    }
    else
    {
        print '<meta http-equiv="refresh" content="0;url=index.php">';
    }
?>




