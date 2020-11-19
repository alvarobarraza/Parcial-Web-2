<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nit = (isset($_POST['nit'])) ? $_POST['nit'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$e_mail = (isset($_POST['e_mail'])) ? $_POST['e_mail'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$comuna = (isset($_POST['comuna'])) ? $_POST['comuna'] : '';
$trabajadores = (isset($_POST['trabajadores'])) ? $_POST['trabajadores'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1:
        $consulta = "INSERT INTO usuarios (nit, nombre, direccion, e_mail, telefono, comuna,trabajadores) VALUES('$nit', '$nombre', '$direccion', '$e_mail', '$telefono', '$comuna', '$trabajadores') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM usuarios ORDER BY nit DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE usuarios SET nit='$nit', nombre='$nombre', direccion='$direccion', e_mail='$e_mail', telefono='$telefono', comuna='$comuna', trabajadores= '$trabajadores' WHERE nit='$nit' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM usuarios WHERE nit='$nit' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM usuarios WHERE nit='$nit' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM usuarios";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;