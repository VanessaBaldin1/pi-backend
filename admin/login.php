<?php
// Iniciar a sessão PHP para futuras funcionalidades
session_start(); // Descomentado

// Incluir autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php'; // Incluindo e corrigindo o caminho

use ConectaConsulta\Models\Admin; // Usar o Admin Model

$erro = null;
$mensagem_sucesso = null; // Inicializar também a mensagem de sucesso

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter e filtrar os dados do formulário
    // Use FILTER_SANITIZE_EMAIL ou outro filtro apropriado para o email
    $usuario_email = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL); 
    $senha_fornecida = $_POST['senha'] ?? ''; 

    // ### Lógica de Autenticação Real ###

    // Validar se os campos foram preenchidos (validação básica)
    if (empty($usuario_email) || empty($senha_fornecida)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        try {
            $adminModel = new Admin();

            // Buscar o administrador pelo email/usuário
            $admin = $adminModel->buscarPorEmail($usuario_email);

            // Verificar se o administrador foi encontrado E se a senha está correta
            if ($admin && password_verify($senha_fornecida, $admin['senha'])) {
                // Autenticação bem sucedida
                // Salvar informações do administrador na sessão
                $_SESSION['admin_logado'] = $admin['id']; // Armazenar o ID do admin logado
                // Opcional: $_SESSION['admin_email'] = $admin['email'];

                // Redirecionar para a página principal da área administrativa
                header('Location: index.php'); // Redirecionar para o index dentro de admin/
                exit; // Importante sair após o redirecionamento

            } else {
                // Credenciais inválidas (usuário não encontrado ou senha incorreta)
                $erro = 'Usuário ou senha inválidos.';
            }

        } catch (\PDOException $e) {
            // Tratar erros de banco de dados durante o login
            $erro = 'Ocorreu um erro no banco de dados durante o login.';
            // Em ambiente de desenvolvimento, você pode querer ver o erro real:
            // error_log('Database Error during login: ' . $e->getMessage());

        } catch (\Exception $e) {
            // Capturar outras exceções gerais durante o login
            $erro = 'Ocorreu um erro inesperado durante o login: ' . $e->getMessage();
             // Opcional: logar o erro real
             // error_log('General Error during login: ' . $e->getMessage());
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
    <link rel="stylesheet" href="../style.css"> <!-- Ajuste o caminho para style.css -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4; /* Cor de fundo similar */
        }
        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 1.5rem;
            color: #333;
        }
        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Inclui padding e border no tamanho */
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
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

        <!-- Adicionar link para a página de cadastro -->
        <p style="margin-top: 1rem;">Não tem uma conta? <a href="register.php">Cadastre-se aqui</a></p>
    </div>
</body>
</html> 