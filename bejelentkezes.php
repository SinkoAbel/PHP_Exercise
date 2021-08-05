<?php


    if ($_SESSION['belepett'] != 'igen')
    {

        print '<br><br>
            <div class="row justify-content-center">
                <div class="col-md-5 bejelentkezes_box">
                    <p class="cim1">Bejelentkezés</p>
        
                        <form method="post">
                            <input type="email" name="email" placeholder="E-mail cím" class="form-control" required>
                            <br>
                            <input type="password" name="jelszo" placeholder="Jelszó" class="form-control" required>
                            <br><br>
                            <input type="submit" name="belepes_gomb" value="Belépés" class="btn btn-primary">
                            
                            <br><br>
                                
                        </form>
                    
                    </div>
                </div>';
    }

    else
    {
        print '<meta http-equiv="refresh" content="0; url=index.php?oldal=rendeles">';
    }


?>
