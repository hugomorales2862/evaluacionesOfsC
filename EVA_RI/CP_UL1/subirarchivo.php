<?php
include_once("../clases/ClsPdfs.php");

$archivo = $_FILES["archivo"];
$evapdf_evaluacion = $_POST["id"];
$evapdf_catalogo = $_POST["catalogo"];
$ClsPdfs = new ClsPdfs();


// echo $id;

$evapdf_ruta = "pdf/$evapdf_evaluacion".'.pdf';
$subir = move_uploaded_file($archivo['tmp_name'], $evapdf_ruta);


// return;

// move_uploaded_file($archivo['tmp_name'], $archivo['name']);
// echo $archivo['name'];

if ($subir) {

    $rs = $ClsPdfs->insertRuta($evapdf_evaluacion, $evapdf_catalogo, $evapdf_ruta);
    // echo $rs;
    if ($rs == 1) {
        //ALERT("SIIII");
        echo 1;
    } else {
        echo 2;
    }
    // print_r($rs);

} else {
    echo 0;
}
