
<?php

if ($_SESSION['belepett'] == 'igen')
{
    if(isset($_POST['rendeles_gomb']))
    {



        mysqli_query($l, "INSERT INTO `megrendeles` SET 
        `id`=NULL,
        `felhasznalo_id`='" . $_SESSION['felhasznalo_id'] . "',
        `rendeles_idopontja` = '" . date("Y-m-d H:i:s") . "'
        ");

        $rendeles_id = mysqli_insert_id($l);

        foreach ($_POST['termek_id'] as $sor)
        {
            mysqli_query($l, "INSERT INTO `leadott_rendeles` SET 
            `id`=NULL,
            `megrendeles_id`='" . $rendeles_id . "',
            `termek_id`='".$sor."'
             ");
        }

            print '<p class="bg-success text-white">Sikeres rendelés!</p>';

    }







    print '<h2 class="container">Válassza ki a megrendelni kívnánt alkatrészeket!</h2>
           <br>';

    print '<form method="post" class="container">
                    Elérhető alkatrészeink (CTRL nyomása mellett többet is választhat!)
                    <br>
                    <select name="termek_id[]" multiple size="3" required>';
    $termek_lek = mysqli_query($l, "SELECT * FROM `termek` ORDER BY `nev`");

    while($termek = mysqli_fetch_array($termek_lek))
    {
        print '<option value="'.$termek['id'].'">'.$termek['gyarto'].'-'.$termek['nev'].' '.$termek['ar'].' Ft</option>';
    }

    print'      </select>
      
      
                    <br>
                    <br>
                    
                    ';

        $termek_lek = mysqli_query($l, "SELECT * FROM `termek` ORDER BY `id`");
        $sor = mysqli_fetch_array($termek_lek);



    print'                             
           <br><br>
                            
                <input type="submit" name="rendeles_gomb" value="Rendeles véglegesítése" class="btn btn-success">
            
           </form>';

}
else
{
    print '<a href="index.php?oldal=bejelentkezes">Ön még nem lépett be, kérjük a regisztráció után jelentkezzen be itt!</a>';
}
?>



