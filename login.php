<?php 

  if (isset($_GET['erro']) && $_GET['erro'] == 1) {
    echo "<script>alert('❌ Email ou senha incorretos!');</script>";
  }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Condomínios em Jogos</title>
  <style>
    /* Tela de carregamento */
    #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      background: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 1s ease;
    }

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

    .login-container {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
    }

    .login-container h1 {
      margin-bottom: 20px;
      color: #333;
    }

    .login-container input {
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
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-login {
      background: #515bd4;
      color: #fff;
    }

    .btn-login:hover {
      background: #3d47a0;
    }

    .btn-register {
      background: #29ccf5;
      color: #fff;
    }

    .btn-register:hover {
      background: #0f5668;
    }

    .btn-voltarhome {
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

    .btn-voltarhome:hover {
      background: #0f5668;
    }

    .erro {
      color: #b00020;
      font-size: 12px;
      text-align: left;
      width: 80%;
      margin: 2px auto 6px auto;
      min-height: 14px;
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

  <div class="login-container">
    <h1>Login</h1>
    <form id="formLogin" action="testlogin.php" method="post" novalidate>
      <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
      <div id="erro-email" class="erro"></div>

      <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
      <div id="erro-senha" class="erro"></div>

      <button type="submit" class="btn btn-login">Entrar</button>
      <button type="button" class="btn btn-register" onclick="window.location.href='register.php'">Registrar</button>
      <a href="home.php" class="btn btn-voltarhome">Voltar</a>
    </form>
  </div>

  <script>
    // Tela de carregamento
    window.addEventListener("load", function() {
      const loading = document.getElementById("loading");
      loading.style.opacity = 0;
      setTimeout(() => loading.style.display = "none", 1000);
    });

    const form = document.getElementById('formLogin');
    const email = document.getElementById('email');
    const senha = document.getElementById('senha');
    const erroEmail = document.getElementById('erro-email');
    const erroSenha = document.getElementById('erro-senha');

    const reSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{6,}$/;

    // Validação em tempo real
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
  </script>
</body>
</html>
