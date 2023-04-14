<?php
$servera_vards = "localhost:3307"; //varbūt localhost:3307

$lietotajvards = "root";

$parole = "";

$db_vards = "pps";

$savienojums = mysqli_connect($servera_vards, $lietotajvards, $parole, $db_vards);

if(!$savienojums){

    die("Pieslēgties neizdevās: ".mysqli_connect_error());

}else{

    #echo "Savienojums ar DB vieksmīgi izveidots!";

}

?>