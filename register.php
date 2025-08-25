<?php
if(isset($_POST['submit'])) {
    include_once('config.php');

    $nome            = $_POST['nomecompleto'];
    $email           = $_POST['email'];
    $senha           = $_POST['senha'];
    $telefone        = $_POST['telefone'];
    $datanascimento  = $_POST['datanascimento'];
    $opcaocondominios= $_POST['opcaocondominios'];

    // Verifica se já existe um usuário com esse e-mail
    $check = mysqli_query($conn, "SELECT id FROM usuarios WHERE email = '$email' LIMIT 1");

    if(mysqli_num_rows($check) > 0) {
        // Já existe -> exibe alerta e redireciona para login.php
        echo "<script>
            alert('⚠️ Já possui um cadastro com esse e-mail!');
            window.location.href = 'login.php';
        </script>";
        exit;
    }

    // Caso não exista, insere novo usuário
    $result = mysqli_query($conn, "INSERT INTO usuarios 
        (nome, email, senha, telefone, datanascimento, opcaocondominios) 
        VALUES ('$nome', '$email', '$senha', '$telefone', '$datanascimento', '$opcaocondominios')");

    if($result){
        echo "<script>
            alert('✅ Usuário registrado com sucesso! Agora faça login.');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Erro ao registrar usuário: ". mysqli_error($conn) ."');
            window.location.href = 'register.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar - Condomínios em Jogos</title>
  <style>
    /* Tela de carregamento */
    #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      background: #ffffff; /* cor de fundo da tela de loading */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 1s ease;
    }

    /* animação de carregamento */
    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #3498db;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg);}
      100% { transform: rotate(360deg);}
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(120deg, #ffffff,#29ccf5);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .register-container {
      background: #fff;
      padding: 60px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
    }

    .register-container h1 {
      margin-bottom: 20px;
      color: #333;
    }

    .register-container input {
      width: 80%;
      padding: 12px;
      margin: 6px 0 2px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    .btn {
      width: 100%;
      padding: 12px;
      margin: 10px 0px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-confirmar {
      background: #515bd4;
      color: #fff;
    }

    .btn-confirmar:hover {
      background: #0f5668;
    }

    .btn-voltarlogin {
      display: block;       /* faz o link se comportar como botão */
      width: 93%;          /* mesma largura do btn-confirmar */
      padding: 12px;
      margin-top: 10px;     /* distancia do botão acima */
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      text-align: center;   /* centraliza o texto */
      background: #29ccf5;
      color: #fff;
      transition: 0.3s;
      text-decoration: none;
    }

    .btn-voltarlogin:hover {
      background: #0f5668;
    }

    .texto-data {
      font-size: 15px;
      color: #0b4c61;
      display: block;
      margin-top: 10px;
    }

    .texto-condominios {
      font-size: 15px;
      color: #0b4c61;
      display: block;
      margin-top: 10px;
    }

    .opcaocondominios {
      width: 85%;
      padding: 12px;
      margin: 6px 0 2px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      font-family: Arial, sans-serif;
      transition: 0.3s;
    }

    .opcaocondominios.ok {
      border-color: #30a46c !important;
    }

    .opcaocondominios.fail {
      border-color: #b00020 !important;
    }

    .erro {
      color: #b00020;
      font-size: 12px;
      text-align: left;
      width: 80%;
      margin: 2px auto 6px auto;
      min-height: 14px; /* evita pulo do layout */
    }

    .ok {
      border-color: #30a46c !important;
    }

    .fail {
      border-color: #b00020 !important;
    }
  </style>
</head>
<body>
  <!-- Tela de carregamento -->
  <div id="loading">
    <div class="spinner"></div>
  </div>

  <div class="register-container">
    <h1>Registrar</h1>
    <form id="formRegistro" action="#" method="post" novalidate>
      <!-- Nome: apenas letras (com acento) e espaço -->
      <input type="text" id="nome" name="nomecompleto" placeholder="Digite seu nome completo" required>
      <div id="erro-nome" class="erro"></div>

      <!-- E-mail: validação nativa do HTML5 já exige @ e formato -->
      <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
      <div id="erro-email" class="erro"></div>

      <!-- Senha: min 6, 1 maiúscula, 1 minúscula e 1 especial -->
      <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
      <div id="erro-senha" class="erro"></div>

      <input type="text" id="telefone" name="telefone" placeholder="Digite seu número de telefone" required>
      <div id="erro-telefone" class="erro"></div>

      <span class="texto-data">Informe sua data de nascimento</span>
      <input type="date" id="datanascimento" name="datanascimento" required>
      <div id="erro-data" class="erro"></div>

      <span class="texto-data">Selecione o condominio onde você mora</span>
      <select name="opcaocondominios" class="opcaocondominios">
        <option value="">Nenhum</option>
        <option value="1">Sun Lake</option>
        <option value="2">Royal Forest</option>
        <option value="3">Royal Park</option>
      </select>

      <button type="submit" name='submit' class="btn btn-confirmar">Confirmar</button>

      <a href="login.php" class="btn btn-voltarlogin">Já possuo conta</a>
    </form>
  </div>

  <script>
    // Quando a página carregar completamente
    window.addEventListener("load", function() {
      const loading = document.getElementById("loading");
      const mainContent = document.getElementById("main-content");

      // Desaparece a tela de loading
      loading.style.opacity = 0;
      setTimeout(() => {
        loading.style.display = "none";
        if(mainContent) mainContent.style.display = "block";
      }, 1000); // tempo igual ao transition
    });

    const form = document.getElementById('formRegistro');
    const nome = document.getElementById('nome');
    const email = document.getElementById('email');
    const senha = document.getElementById('senha');
    const dataNasc = document.getElementById('datanascimento');
    const telefone = document.getElementById('telefone');
    const selectCondominio = document.querySelector('select[name="opcaocondominios"]');

    const erroNome = document.getElementById('erro-nome');
    const erroEmail = document.getElementById('erro-email');
    const erroSenha = document.getElementById('erro-senha');
    const erroData = document.getElementById('erro-data');
    const erroTelefone = document.getElementById('erro-telefone');
    const erroCondominio = document.createElement('div'); // div para mensagem de erro do select
    erroCondominio.className = 'erro';
    selectCondominio.parentNode.insertBefore(erroCondominio, selectCondominio.nextSibling);

    // Regex:
    const reNome = /^[A-Za-zÀ-ÿ\s]+$/;
    const reSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{6,}$/;

    // Validações em tempo real
    nome.addEventListener('input', () => {
      nome.value = nome.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
      if (!nome.value.trim()) {
        setFail(nome, erroNome, 'Informe seu nome.');
      } else if (!reNome.test(nome.value)) {
        setFail(nome, erroNome, 'Use apenas letras e espaços.');
      } else {
        setOk(nome, erroNome);
      }
    });

    email.addEventListener('input', () => {
      if (!email.value.trim()) {
        setFail(email, erroEmail, 'Informe seu e-mail.');
      } else if (!email.checkValidity()) {
        setFail(email, erroEmail, 'E-mail inválido. Deve conter "@" e domínio.');
      } else {
        setOk(email, erroEmail);
      }
    });

    senha.addEventListener('input', () => {
      if (!senha.value) {
        setFail(senha, erroSenha, 'Informe sua senha.');
      } else if (!reSenha.test(senha.value)) {
        setFail(senha, erroSenha, 'Mín. 6 caracteres, com 1 maiúscula, 1 minúscula e 1 caractere especial.');
      } else {
        setOk(senha, erroSenha);
      }
    });

    dataNasc.addEventListener('input', () => {
      if (!dataNasc.value) {
        setFail(dataNasc, erroData, 'Informe sua data de nascimento.');
      } else {
        setOk(dataNasc, erroData);
      }
    });

    telefone.addEventListener('input', () => {
      // Permite apenas números
      telefone.value = telefone.value.replace(/[^0-9]/g, '');
      if (!telefone.value.trim()) {
        setFail(telefone, erroTelefone, 'Informe seu telefone.');
      } else {
        setOk(telefone, erroTelefone);
      }
    });

    selectCondominio.addEventListener('change', () => {
      if (!selectCondominio.value) {
        setFail(selectCondominio, erroCondominio, 'Selecione um condomínio participante.');
      } else {
        setOk(selectCondominio, erroCondominio);
      }
    });

    form.addEventListener('submit', (e) => {
      let valido = true;

      if (!nome.value.trim() || !reNome.test(nome.value)) {
        setFail(nome, erroNome, 'Use apenas letras e espaços.');
        valido = false;
      }
      if (!email.value.trim() || !email.checkValidity()) {
        setFail(email, erroEmail, 'E-mail inválido. Deve conter "@" e domínio.');
        valido = false;
      }
      if (!senha.value || !reSenha.test(senha.value)) {
        setFail(senha, erroSenha, 'Mín. 6 caracteres, com 1 maiúscula, 1 minúscula e 1 caractere especial.');
        valido = false;
      }
      if (!dataNasc.value) {
        setFail(dataNasc, erroData, 'Informe sua data de nascimento.');
        valido = false;
      }
      if (!telefone.value.trim()) {
        setFail(telefone, erroTelefone, 'Informe seu telefone.');
        valido = false;
      }
      if (!selectCondominio.value) {
        setFail(selectCondominio, erroCondominio, 'Selecione um condomínio participante.');
        valido = false;
      }

      if (!valido) e.preventDefault();
    });

    function setOk(input, boxErro) {
      input.classList.remove('fail');
      input.classList.add('ok');
      boxErro.textContent = '';
    }

    function setFail(input, boxErro, msg) {
      input.classList.remove('ok');
      input.classList.add('fail');
      boxErro.textContent = msg || 'Campo inválido.';
    }
  </script>
</body>
</html>
