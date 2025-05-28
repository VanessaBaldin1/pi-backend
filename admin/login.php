<?php
// Iniciar a sessão PHP para futuras funcionalidades
session_start(); // Iniciar a sessão


require_once __DIR__ . '/../vendor/autoload.php'; 

use ConectaConsulta\Models\Admin; 

$erro = null;
$mensagem_sucesso = null; // Inicializar também a mensagem de sucesso

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    
    $usuario_email = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL); 
    $senha_fornecida = $_POST['senha'] ?? ''; 


    // Validação dos campos que foram preenchidos
    if (empty($usuario_email) || empty($senha_fornecida)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        try {
            $adminModel = new Admin();

            // Busca o administrador pelo email/usuário
            $admin = $adminModel->buscarPorEmail($usuario_email);

            // Verifica se o administrador foi encontrado E se a senha está correta
            if ($admin && password_verify($senha_fornecida, $admin['senha'])) {
               
                // Salva informações do administrador na sessão
                $_SESSION['admin_logado'] = $admin['id']; 
                header('Location: index.php'); 
                exit;

            } else {
                $erro = 'Usuário ou senha inválidos.';
            }

        } catch (\PDOException $e) {
            $erro = 'Ocorreu um erro no banco de dados durante o login.';
           

        } catch (\Exception $e) {
            // Captura outras exceções gerais durante o login
            $erro = 'Ocorreu um erro inesperado durante o login: ' . $e->getMessage();
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <div class="login-container">
        <h1>Login Administrativo</h1>
        
        <?php if ($erro): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($mensagem_sucesso)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($mensagem_sucesso); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form">
            <div class="form-group">
                <label for="usuario">Usuário/Email:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <p style="margin-top: 1rem;">Não tem uma conta? <a href="register.php">Cadastre-se aqui</a></p>
    </div>
</body>
</html> 