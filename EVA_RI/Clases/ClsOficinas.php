<?php
require_once ("ClsConex.php");

class ClsOficinas extends ClsConex{

	function obtener_oficina($usuario){
		$sql = " SELECT m.org_plaza,  m.org_plaza_desc";
		$sql.= " FROM morg as m";
		$sql.= " WHERE org_dependencia = (";
		$sql.= " select org_dependencia from morg,  mper";
		$sql.= " where per_plaza=org_plaza";
		$sql.= " and per_catalogo=$usuario";
		$sql.= " )";
		$sql.= " and org_jerarquia[1] =";
		$sql.= " (select org_jerarquia[1] from morg, mper";
		$sql.= " where per_plaza=org_plaza";
		$sql.= " and per_catalogo=$usuario";
		$sql.= " )";
		$sql.= " and org_jerarquia[2,3] =";
		$sql.= " (select org_jerarquia[2,3] from morg, mper";
		$sql.= " where per_plaza=org_plaza";
		$sql.= " and per_catalogo=$usuario";
		$sql.= " )";
		$sql.= " and org_jerarquia like '%0000000'";
		$result = $this->exec_query($sql);
		return $result;
	}



	


}	
?>
