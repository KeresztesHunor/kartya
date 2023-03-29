<?php
    include_once './Ab.php';
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stilus.css">
        <title>Keresztes Hunor</title>
    </head>
    <body>
        <main>
            <?php
                $adatbazis = new Ab();
                echo ujTagekKozeIr("table", null, (function() use(&$adatbazis)
                {
                    $txt = "";
                    $txt .= ujTagekKozeIr("thead", null, ujTagekKozeIr("tr", null, (function()
                    {
                        $txt = "";
                        $txt .= ujTagekKozeIr("th", null, "Név");
                        $txt .= ujTagekKozeIr("th", null, "Kép");
                        return $txt;
                    })()));
                    $txt .= ujTagekKozeIr("tbody", null, $adatbazis->adatLeker2("név", "kép", "szín"));
                    return $txt;
                })());
                $adatbazis->kapcsolatBezar();
            ?>
        </main>
    </body>
</html>