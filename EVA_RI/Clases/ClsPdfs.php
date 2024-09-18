
<?php
require_once("ClsConex.php");
header("Content-Type: text/html;charset=utf-8");
class ClsPdfs extends ClsConex{

    function insertRuta($evapdf_evaluacion, $evapdf_catalogo, $evapdf_ruta)
        {
           
            $sql = "INSERT INTO eva_pdf (evapdf_evaluacion, evapdf_catalogo, evapdf_ruta) 
        VALUES ($evapdf_evaluacion, $evapdf_catalogo, '$evapdf_ruta')";
            $result = $this->exec_sql($sql);

    
            return $result;
        }


        function buscarPdf()
        {
           
            $sql = "SELECT * FROM eva_pdf";
            $result = $this->exec_sql($sql);

    
            return $result;
        }

}