<?php
require_once("../Clases/ClsPersonal.php");
require_once("../Clases/Ingreso.php");
date_default_timezone_set('America/Guatemala');



function tablaPerosnalAprobo($dependencia, $comp_eva, $usuario)
{
    $ClsPer = new ClsPersonal();
    $result = $ClsPer->get_oficiales_fin1($dependencia, $comp_eva, $usuario);
    $salida = '';
    if ($result != "") {
        $salida .= "<table border='1' cellspacing='0' cellpadding='5'>";  // Borde, espaciado y relleno
        $salida .= '<thead style="background-color: yellow;">';  // Color de fondo amarillo
        $salida .= '<tr>';
        $salida .= '<th width="75px" align="center"><font size="2"><b>No.</b></font></th>';
        $salida .= '<th width="75px" align="center"><font size="2"><b>EVALUACION</b></font></th>';
        $salida .= '<th width="75px" align="center"><font size="2"><b>CATALOGO</b></font></th>';
        $salida .= '<th width="150px" align="center"><font size="2"><b>GRADO</b></font></th>';
        $salida .= '<th width="350px" align="center"><font size="2"><b>NOMBRE COMPLETO</b></font></th>';
        $salida .= '<th width="150px" align="center"><font size="2"><b>APROBO</b></font></th>';
        $salida .= '<th width="150px" align="center"><font size="2"><b>SITUACION</b></font></th>';
        $salida .= '<th width="1px" align="center"></th>';
        $salida .= '</tr>';
        $salida .= '</thead>';
        $salida .= '<tbody>';
        $cont = 0;
        foreach ($result as $row) {
            $cont++;
            $nombre = trim($row['PER_NOM1']) . " " . trim($row['PER_NOM2']) . " " . trim($row['PER_APE1']) . " " . trim($row['PER_APE2']);
            $gra_desc = trim($row['GRA_DESC_CT']);
            $grado = $row['GRA_CODIGO'];
            $arm_desc = trim($row['ARM_DESC_CT']);
            $periodo = $row['EVA_PERIODO'];
            $catalogo = $row['EVA_CAT1'];
            $eva_id = $row['EVA_ID'];
            $usuario = $row['EVA_USUARIO'];
            $situacion = $row['EVA_SITUACION'];
            $salida .= '<tr';
            if ($cont % 2 == 0) {
                $salida .= ' class="odd gradeX">';
            } else {
                $salida .= ' class="success">';
            }
            $salida .= "<td><font size='2'>" . $cont . "</font></td>";
            $salida .= "<td><font size='2'>" . $periodo . "</font></td>";
            $salida .= "<td><font size='2'>" . $catalogo . "</font></td>";
            if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40) {
                $salida .= "<td><font size='2'>" . $gra_desc . "</font></td>";
            } else {
                $salida .= "<td><font size='2'>" . $gra_desc . ' ' . $arm_desc . "</font></td>";
            }
            $salida .= "<td><font size='2'>" . $nombre . "</font></td>";
            $salida .= "<td><font size='2'>" . $usuario . "</font></td>";
            if ($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19  or $situacion == 22 or $situacion == 27 or $situacion == 35) {
                $salida .= "<td><font size='2'>PENDIENTE</font></td>";
                $salida .= "<td align='center'><a href='../CP_REP/REP_eva.php?eva=" . $eva_id . "' target='_blank' type='button' class='btn btn-warning' title='Generar reporte final'><i class='icon-file'></i></a></td>";
            } elseif ($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 31 or $situacion == 32 or $situacion == 33) {
                $salida .= "<td><font size='2'>APROBADA</font></td>";
            } elseif ($situacion == 34) {
                $salida .= '<td align="center"><font size="2">IMPUGNADO</font></td>';
            }
            $salida .= '</tr>';
        }
        $salida .= '</tbody>';
        $salida .= '</table>';
    } else {
        $salida .= "<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
    }
    return $salida;
}

    

?>