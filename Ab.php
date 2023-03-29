<?php
    class Ab
    {
        private $host = "localhost";
        private $felhasznaloNev = "root";
        private $jelszo = "";
        private $abNev = "magyar_kartya";
        private $kapcsolat;

        function __construct()
        {
            $this->kapcsolat = new mysqli($this->host, $this->felhasznaloNev, $this->jelszo, $this->abNev);
            //echo "<p>".($this->kapcsolat->connect_error ? "Sikertelen kapcsolódás!" : "Sikeres kapcsolódás!")."</p>";
            $this->kapcsolat->query("SET NAMES UTF8");
            $this->kapcsolat->query("set character set UTF8");
        }

        function adatLeker($oszlop, $tabla)
        {
            $sql = "SELECT $oszlop FROM $tabla";
            $phpTomb = $this->kapcsolat->query($sql);
            while ($sor = $phpTomb->fetch_row())
            {
                echo "<img src='forras/$sor[0]' alt='Kártya képe'>";
                echo "<br>";
            }
        }

        function adatLeker2($oszlop1, $oszlop2, $tabla)
        {
            $sql = "SELECT $oszlop1, $oszlop2 FROM $tabla";
            $phpTomb = $this->kapcsolat->query($sql);
            $txt = "";
            while ($sor = $phpTomb->fetch_assoc())
            {
                $txt .= ujTagekKozeIr("tr", null, (function() use(&$sor, &$oszlop1, &$oszlop2)
                {
                    $txt = "";
                    $txt .= ujTagekKozeIr("th", null, $sor[$oszlop1]);
                    $txt .= ujTagekKozeIr("td", null, kepetIr("forras/$sor[$oszlop2]", "Kártya képe"));
                    return $txt;
                })());
            }
            return $txt;
        }

        function kapcsolatBezar()
        {
            $this->kapcsolat->close();
        }
    }

    function ujTagekKozeIr($tag, $parameterek = null, $tartalom = "")
    {
        return "<$tag".($parameterek ? " $parameterek" : "").">$tartalom</$tag>";
    }

    function kepetIr($src, $alt, $parameterek = null)
    {
        return "<img src='$src' alt='$alt'".($parameterek ? " $parameterek" : "").">";
    }
?>
