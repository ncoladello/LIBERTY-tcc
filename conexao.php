<?php

function conectar()
{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "liberty";

    $con = new mysqli($servidor, $usuario, $senha, $bd);
    return $con;
}

$conexao = conectar();


?>