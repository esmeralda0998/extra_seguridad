<?php
include_once "conexion.php";
include_once "funciones.php";

#Salir si alguno de los datos no está presente
if(!isset($_POST["nombre"]) || !isset($_POST["nameUser"]) || !isset($_POST["sexo"]) || !isset($_POST["numero"]) || !isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["id_type"])){
    exit();
}else{

    $keyAES = generatekey();
    $inivec = base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')));

    $nombre = $_POST["nombre"];
    $nameUser = $_POST["nameUser"];
    $sexo = $_POST["sexo"];
    $numero = $_POST["numero"];
    $email = $_POST["email"];
    $id_type = $_POST["id_type"];
    $password = $_POST["password"];

    $pswd=cifrarAES($password, $keyAES, $inivec);

    $sentencia = $base_de_datos->prepare("INSERT INTO users(nombre, nameUser, sexo, Telefono, email, pwd, keyAES, inivec, id_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $nameUser, $sexo, $numero, $email, $pswd, $keyAES, $inivec, $id_type]); 


    if($resultado === TRUE){
        header("Location: ../tablaAES.php");
        die();
    }else echo "Algo salió mal. Por favor verifica que la tabla exista";

};

?>