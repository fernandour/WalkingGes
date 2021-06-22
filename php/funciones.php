<?php
/****************************************/
/************ Base de datos *************/
/****************************************/

function conectar_bd() {
	
	// LOCAL
    $db_host="localhost";
    $db_nombre="WalkingGes";
    $db_user="walking";
    $db_pass="walking1234";
	
	/*
	// HEROKU
    $db_host="us-cdbr-east-04.cleardb.com";
    $db_nombre="heroku_7f2cb8c976f52c8";
    $db_user="b2e7c75e2ab9eb";
    $db_pass="91796ed2";
	*/
    $bd = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre);
    if (!$bd) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    mysqli_set_charset($bd,"utf8");
    return $bd;
}
function cerrar_bd($bd) {
    mysqli_close($bd);
}

function query_registros($sql) {
    $bd = conectar_bd();
    $query = mysqli_query($bd, $sql) or die("Error SQL: $sql");
    $registros = array();
    while($registro = mysqli_fetch_assoc($query)) {
        $registros[] = $registro;
    }
    mysqli_free_result($query);
    cerrar_bd($bd);
    return $registros;
}
function query_registro($sql) {
	$bd = conectar_bd();
    $query = mysqli_query($bd, $sql) or die("Error SQL: $sql");
    $registro = array();
    $registro = mysqli_fetch_array($query);
    mysqli_free_result($query);
    cerrar_bd($bd);
    return $registro;
}
function query_ejecutar($sql) {
    $bd = conectar_bd();
    mysqli_query($bd, $sql) or die("Error SQL: $sql");
    cerrar_bd($bd);
}
function query_ejecutar_id($sql) {
    $bd = conectar_bd();
    mysqli_query($bd, $sql) or die("Error SQL: $sql");
    $id = mysqli_insert_id($bd);
    cerrar_bd($bd);
    return $id;
}

/********************************************/
/************ Tratamiento datos *************/
/********************************************/
function recoger_texto($texto) {
	if($texto == "") {
		$texto = "''";
	} else {
		$texto = "'" . addslashes($texto) . "'";
	}
	return $texto;
}
function recoger_numero($numero) {
	if($numero == "") {
		$numero = 0;
	} else {
		$numero = str_replace ( ",", ".", $numero);
	}
	return $numero;
}
function recoger_logico($logico) {
	if($logico=='true' || $logico=='on') {
		$logico = "'S'";
	} else {
		$logico = "'N'";
	}
	return $logico;
}
function recoger_fecha($fecha) {
	if($fecha != '') {
		preg_match( "/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/", $fecha, $mifecha); 
		$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
		$lafecha = "'" . $lafecha . "'";
		return $lafecha; 
	} else {
		return "''";
	}
}

function presentar_numero($numero) {
	$numero = number_format($numero,2,",",".");
	return $numero;
}
function presentar_numero_entero($numero) {
	$numero = number_format($numero,0,",",".");
	return $numero;
}
function presentar_logico($valor) {
	if($valor == 'S') {
		$respuesta = 'Si';
	} else {
		$respuesta = 'No';
	}
	return $respuesta;
}
function presentar_fecha($fecha) {
	if($fecha == '0000-00-00') {
		return '-';
	} 
	if($fecha != '') {
		preg_match( "/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha); 
		$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
		return $lafecha;
	} else {
		return NULL;
	}
}
function presentar_hora($hora) { 
	if($hora != '') {
		preg_match( "/([0-9]{2,4}):([0-9]{1,2}):([0-9]{1,2})/", $hora, $mihora); 
		$lahora=$mihora[1].":".$mihora[2]; 
		return $lahora;
	} else {
		return NULL;
	}
}
function redondear_dos_decimales($valor) { 
   $redondeado=round($valor * 100) / 100; 
   return $redondeado; 
}
function redondear_dos_decimales_coma($valor) { 
	$redondeado=round($valor * 100) / 100; 
	$redondeado=str_replace ( ".", ",", $redondeado);
	return $redondeado; 
}