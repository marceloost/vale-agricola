<?php

require_once "../../settings/config.php";

session_start();

if (!isset($_SESSION["idEmpresa"])) {
    header("location: ../login");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Usuário Logado</h1>
</body>
</html>