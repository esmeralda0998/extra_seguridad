<?php
include_once "conexion.php";
include_once "funciones.php";

$nombre = $_POST["nombre"];
$nameUser = $_POST["nameUser"];
$sexo = $_POST["sexo"];
$numero = $_POST["numero"];
$email = $_POST["email"];
$id_type = $_POST["id_type"];
$password = $_POST["password"];
$id_USER = $_POST["id_USER"];

$keyAES = generatekey();
$inivec = generatekey();

$pswd=FALSE;
$key = hash('sha256', $keyAES);
$i = substr(hash('sha256',$inivec),0,16);
$pswd = openssl_encrypt($password, 'aes-256-cbc', $key, 0,$i);
$pswd = base64_encode($pswd);

$sentencia = $base_de_datos->prepare("UPDATE users SET nombre = ?, nameUser = ?, sexo = ?, Telefono = ?, email = ?, pwd = ?, keyAES = ?, inivec = ?, id_type = ? WHERE id = ?;");
$resultado = $sentencia->execute([$nombre, $nameUser, $sexo, $numero, $email, $pswd, $keyAES, $inivec, $id_type, $id_USER]); # Pasar en el mismo orden de los ?

if($resultado === TRUE){
    header("Location: ../tablaHashv2.php");
    die();
}else{
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
?>