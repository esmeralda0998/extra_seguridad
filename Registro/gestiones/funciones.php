<?php

//funcion para crear llave de cifrado de contraseña
function generatekey(){
    $key = "";
    $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    $max = strlen($pattern)-1;
    for($i = 0; $i < 5; $i++){
        $key .= substr($pattern, mt_rand(0,$max), 1);
    }
    return $key;
}

//funcion para encriptar-desencriptar de forma AES
function cifrarAES($passW, $llave, $inivec){
    return openssl_encrypt($passW, 'aes-256-cbc', $llave, false, $inivec);    
}

function desifradoAES($passW, $llave, $inivec){
    $encrypted_data = base64_decode($passW);
    return openssl_decrypt($passW, 'aes-256-cbc', $llave, false, $inivec);
}

//funcion para encriptar de forma RSA
function cifrarRSA($passW, $llave, $inivec){
    $encrypyted=openssl_encrypt($passW, 'aes-256-cbc', $llave, false, $inivec);
}

function cifrarRSA_2($encrypyted, $inivec){    
    return base64_encode($encrypyted.'::'.$inivec);
}

function desifradoRSA($passW, $llave, $inivec){
    $iv = $inivec;
    list($encrypted_passW, $iv) = explode('::', base64_decode($passW),2);
    return openssl_decrypt($encrypted_passW, 'aes-256-cbc', $llave, 0,$iv);
}

?>