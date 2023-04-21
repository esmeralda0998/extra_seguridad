<?php
include_once "conexion.php";

$nombre = $_POST["nombre"];
$nameUser = $_POST["nameUser"];
$sexo = $_POST["sexo"];
$numero = $_POST["numero"];
$email = $_POST["email"];
$id_type = $_POST["id_type"];
$password = $_POST["password"];
$id_USER = $_POST["id_USER"];

$options = [
    'cost' => 12,
];

$pswd = password_hash($pass, PASSWORD_BCRYPT, $options);

$sentencia = $base_de_datos->prepare("UPDATE users SET nombre = ?, nameUser = ?, sexo = ?, Telefono = ?, email = ?, pwd = ?, keyAES = ?, inivec = ?, id_type = ? WHERE id = ?;");
$resultado = $sentencia->execute([$nombre, $nameUser, $sexo, $numero, $email, $pswd, "", "", $id_type, $id_USER]); # Pasar en el mismo orden de los ?

if($resultado === TRUE){
    header("Location: ../tablaCifradoPropio.php");
    die();
}else{
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
?>