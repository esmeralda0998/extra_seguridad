<?php

include_once "conexion.php";
include_once "funciones.php";

$keyAES = generatekey();
$inivec = base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')));


$nombre = $_POST["nombre"];
$nameUser = $_POST["nameUser"];
$sexo = $_POST["sexo"];
$numero = $_POST["numero"];
$email = $_POST["email"];
$id_type = $_POST["id_type"];
$password = $_POST["password"];
$id_USER = $_POST["id_USER"];

$pswd=cifrarRSA($password, $keyAES, $inivec);
$pswd_2=cifrarRSA_2($pswd, $inivec);

$sentencia = $base_de_datos->prepare("UPDATE users SET nombre = ?, nameUser = ?, sexo = ?, Telefono = ?, email = ?, pwd = ?, keyAES = ?, inivec = ?, id_type = ? WHERE id = ?;");
$resultado = $sentencia->execute([$nombre, $nameUser, $sexo, $numero, $email, $pswd_2, $keyAES, $inivec, $id_type, $id_USER]); # Pasar en el mismo orden de los ?

if($resultado === TRUE){
    header("Location: ../tablaRSA.php");
    die();
}else{
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
?>
?>