<?php
require_once "../../settings/config.php";
session_start();

if (!isset($_SESSION["idEmpresa"])) {
    header("location: ../login");
}

if (!isset($_GET["idEmpresa"])) {
    // Redirecionar para a página anterior ou exibir uma mensagem de erro
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

$idEmpresa = $_GET["idEmpresa"];
$documentos = Documento::findallByEmpresa($idEmpresa);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vale Agrícola | Documentos da Empresa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../../settings/imagens/logo-alto-feliz.png" alt="logoaf">
        </div>
        <div class="icone">
            <img src="../../settings/imagens/icone-contraste.png" alt="iconedl">
        </div>
    </header>    

    <div class="home-page-util">
        <div class="home-page">
            <h2 class="titulo">Documentos da Empresa</h2>
            <?php foreach ($documentos as $documento) { ?>
                <?php
                $caminhoDocumento = '../../documentos/' . $documento->getIdDocumento() . '/' . $documento->getPdf();
                ?>
                <a href="<?php echo $caminhoDocumento; ?>" download="<?php echo basename($caminhoDocumento); ?>" class="document">
                    
                    <p><?php echo $documento->getNome();?> - <?php echo $documento->getValidade()->format("d/m/Y"); ?></p>
                    
                </a>
            <?php } ?>
            
            <div class="buttons">
                <a href="../home_prefeitura" class="botao-voltar">Voltar</a>
                <a href="../../enviar_email/enviarEmail.php">Enviar Email</a>
            </div>
        </div>
    </div>
    
</body>
</html>