<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sinkó Ábel felvételi teszt</title>

    <link rel="stylesheet" href="style.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">


</head>
<body>

<?php


    if (isset($_POST['belepes_gomb']))
    {
$l = mysqli_connect('localhost', 'root', '', 'greensys');

        $email = mysqli_real_escape_string($l, $_POST['email']);
        $jelszo = mysqli_real_escape_string($l, $_POST['jelszo']);

        $kodolt_jelszo = hash('sha256', $jelszo);

        $query = mysqli_query($l, "SELECT * FROM `felhasznalo` WHERE `email` = '".$email."' AND `jelszo` = '".$kodolt_jelszo."'");
        $darab = mysqli_num_rows($query);


        if ($darab == 1)
        {
            $query2 = mysqli_query($l, "SELECT * FROM `felhasznalo` WHERE `email` = '".$email."' AND `visszaigazolva` = 'igen'");
            $darab2 = mysqli_num_rows($query2);

            if ($darab2 == 1)
            {

                $query3 = mysqli_query($l, "SELECT * FROM `felhasznalo` WHERE `email` = '".$email."'");

                $ugyfeladat = mysqli_fetch_array($query3);

                $_SESSION['belepett'] = 'igen';
                $_SESSION['teljes_nev'] = $ugyfeladat['teljes_nev'];
                $_SESSION['email'] = $ugyfeladat['email'];
                $_SESSION['felhasznalo_id'] = $ugyfeladat['id'];



            }
            else
            {
                print '<p class="bg-danger text-white">Az email címét még nem erősítette meg, kérjük ellenőrizze a postafiókját!</p>';
            }


        }
        else
        {
            print '<p class="bg-danger text-white">Hibás email cím vagy jelszó!</p>';
        }

        mysqli_close($l);
    }


?>



<nav class="navbar navbar-expand-md bg-dark navbar-dark">

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>



        div class="collapse navbar-collapse" id = "collapsibleNavbar" >
        <ul class="navbar-nav" >
            <li class="nav-item" >
                <a class="nav-link" href = "index.php?oldal=kezdolap" >Kezdőlap</a >
            </li>
            <li class="nav-item" >
                <a class="nav-link" href = "index.php?oldal=sudoku" >Sudoku</a >
            </li >
            <li class="nav-item">
                <a class="nav-link" href="index.php?oldal=javascript">JavaScript</a>
            </li>
            <?php

            if ($_SESSION['belepett'] != "igen")

            {
            print '<li class="nav-item" >
                        <a class="nav-link" href = "index.php?oldal=bejelentkezes" > Bejelentkezés</a >
                   </li >
                   <li class="nav-item" >
                        <a class="nav-link" href = "index.php?oldal=regisztracio" > Regisztráció</a >
                   </li >';
            }
            ?>

            <?php

            if($_SESSION['belepett'] == "igen")
            {
            print '<li class="nav-item" >
                       <a class="nav-link" href = "index.php?oldal=rendeles" >Rendelés</a >
                   </li >
                   <li class="nav-item" >
                       <a class="nav-link" href = "index.php?oldal=kilepes" >Kilépés</a >
                   </li>';
            }
            ?>


        </ul>
    </div>
</nav>







<?php


$l = mysqli_connect('localhost', 'root', '', 'greensys');


switch($_GET['oldal'])
{
    case 'regisztracio': include 'regisztracio.php'; break;
    case 'visszaigazolas': include 'visszaigazolas.php'; break;
    case 'bejelentkezes': include 'bejelentkezes.php'; break;
    case 'rendeles': include 'rendeles.php'; break;
    case 'kilepes': include 'kilepes.php'; break;
    case 'sudoku': include 'sudoku.php'; break;
    case 'javascript': include 'javascript.php'; break;

    default: include 'kezdolap.php'; break;

}

mysqli_close($l)

?>

</body>
</html>