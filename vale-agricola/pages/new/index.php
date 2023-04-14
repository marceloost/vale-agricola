<?php

require_once "../../settings/config.php";
ini_set('error_reporting', E_ALL); 
ini_set('display_errors', 1);

if (isset($_POST["button"])) {
  if ($_POST["senha"] != $_POST["confirmar-senha"]) {
      echo "As senhas não coincidem";
  } else {
      $empresa = new Empresa();
      $empresa->constructorCreate(
          trim($_POST["nome"]),
          trim($_POST["senha"]),
          trim($_POST["email"]),
          $_POST["cnpj"]
      ); 
      $empresa->save();
      
      header("location: ../new-confirm/");
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vale Agrícola | Criar Conta</title>
  <script src="scripts.js"></script>
  <link rel="stylesheet" href="new.css">
</head>
<body>
    <section class="form">
        <h1 class="titulo">Criar Conta</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">

            <label for="cnpj">CNPJ:</label>
            <input type="string" name="cnpj" id="cnpj" required placeholder="Digite o CNPJ de sua empresa aqui">

            <label for="fullname">Nome:</label>
            <input type="text" name="nome" id="nome" required placeholder="Digite o nome de sua empresa aqui">

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required placeholder="Digite seu e-mail aqui">

            <label for="password">Senha:</label>
            <input type="password" name="senha" id="senha" maxlength="20" required placeholder="Digite sua senha aqui">

            <label for="password">Confirmar Senha:</label>
            <input type="password" name="confirmar-senha" id="confirmar-senha" maxlength="20" required placeholder="Confirme sua senha aqui">

            <input type="submit" value="Criar" name="button" class="botao">

            <a href="../login">Voltar</a>
        </form>
    </section>
</body>
</html>

<!-- Incluindo o jQuery e o jQuery Mask Plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<!-- Aplicando a máscara de CNPJ -->
<script>
$(document).ready(function(){
  $('#cnpj').mask('00.000.000/0000-00');
});
</script>

<!-- Aplicando a máscara de Nome -->
<script>
  $(document).ready(function() {
    $('#nome').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {
      translation: {
      'A': { pattern: /[A-Za-zÀ-ú\s]/ }
      }
    });
  });
</script>

<!-- Aplicando a máscara de e-mail -->
<script>
$(document).ready(function(){
  $('#email').mask("A", {
    translation: {
      "A": { pattern: /[\w@\-.+]/, recursive: true }
    }
  }).on("blur", function(){
    let email = $(this).val();
    if(!isValidEmail(email)){
      $(this).val("");
    }
  });
});

function isValidEmail(email) {
  let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}
$(document).ready(function(){
  $('#confirmar-senha').on('input', function() {
    if ($(this).val() != $('#senha').val()) {
      this.setCustomValidity("As senhas não coincidem");
    } else {
      this.setCustomValidity('');
    }
  });
});

document.querySelector('.botao').addEventListener('click', function(event) {
  var cnpj = document.getElementById("cnpj").value;
  var nome = document.getElementById("nome").value;
  var email = document.getElementById("email").value;
  var senha = document.getElementById("senha").value;
  var confirmarSenha = document.getElementById("confirmar-senha").value;

  if (cnpj.trim() === '' || nome.trim() === '' || email.trim() === '' || senha.trim() === '' || confirmarSenha.trim() === '' || !validarEmail(email)) {
    alert("Por favor, preencha os campos corretamente.");
    event.preventDefault();
  } else if (senha !== confirmarSenha) {
      alert("As senhas não coincidem.");
    event.preventDefault();
  } else if (confirm("Tem certeza que deseja criar uma conta?")) {
      alert("Sua conta foi criada com sucesso.");
    // confirmarCriacao();
  } else {
      event.preventDefault();
  }
});


</script>