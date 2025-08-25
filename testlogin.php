<?php
    /*if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {

        include_once('config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

        $result = $conn->query($sql);

        if($result->num_rws > 0) {
            echo 'Login realizado com sucesso!';
        }
    }
    else {
        echo "E-mail ou senha incorretos!";
        header('Location: login.php');
    }*/

session_start();

// Conexão com banco
$conn = new mysqli("localhost", "root", "", "cadastro-usuarios");

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Pegando os dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Verifica se o usuário existe
$sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$result = $stmt->get_result();
$_SESSION['usuario'] = $usuario['id'];
$_SESSION['usuario'] = $usuario['nome'];
$_SESSION['usuario'] = $usuario['email'];

if ($result->num_rows > 0) {
    // Pega os dados do usuário
    $usuario = $result->fetch_assoc();

    // Salva cada dado na sessão
    $_SESSION['usuario_id']    = $usuario['id'];
    $_SESSION['usuario_nome']  = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];

    header("Location: homeloged.php"); // Redireciona para a Home logada
    exit;
} else {
    // Se não encontrou usuário, volta para login com erro
    header("Location: login.php?erro=1");
    exit;
}

?>