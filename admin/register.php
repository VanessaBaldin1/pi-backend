<?php

// Inicializa variáveis para evitar warnings
$erro = null;
$sucesso = null;


require_once __DIR__ . '/../vendor/autoload.php';

use ConectaConsulta\Models\Admin; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Capta e filtra os dados do formulário
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? ''; // Senhas não devem ser filtradas diretamente com sanitize filters
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Validação antes de interagir com o BD 
    if (!$email) {
        $erro = 'Por favor, insira um email válido.';
    } elseif (empty($senha) || empty($confirmar_senha)) {
        $erro = 'Por favor, preencha todos os campos de senha.';
    } elseif ($senha !== $confirmar_senha) {
        $erro = 'As senhas não coincidem.';
    } elseif (strlen($senha) < 6) { // Exemplo: senha mínima de 6 caracteres
        $erro = 'A senha deve ter pelo menos 6 caracteres.';
    } else {

        try {
            $adminModel = new Admin();

            // Verificar se o email já existe ANTES de tentar inserir (melhor UX)
            if ($adminModel->buscarPorEmail($email)) {
                $erro = 'Este email já está cadastrado.';
            } else {
                // Criptografar a senha
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                // Salvar no banco de dados
                if ($adminModel->criar($email, $senhaHash)) {
                    $sucesso = 'Administrador cadastrado com sucesso! Você pode fazer login agora.';
                   
                } else {
                    // Se o criar retornar false por algum motivo 
                    $erro = 'Erro ao cadastrar administrador.';
                }
            }
        } catch (\PDOException $e) {
            // Tratar erros específicos do banco de dados que podem ocorrer aqui
          
            if ($e->getCode() === '23000') {
                 $erro = 'Este email já está cadastrado.';
            } else {
                 $erro = 'Ocorreu um erro no banco de dados ao tentar cadastrar.<br>Detalhes: ' . $e->getMessage();
               
            }
        } catch (\Exception $e) {
            // Capturar outras exceções gerais
            $erro = 'Ocorreu um erro inesperado durante o cadastro: ' . $e->getMessage();
      
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Administrativo</title>
    <link rel="stylesheet" href="./../style.css"> 
</head>
<body>
    <div class="register-container">
        <h1>Cadastro Administrativo</h1>

        <?php
        // Exibir mensagens de erro ou sucesso
        if ($erro): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>

        <?php
        if ($sucesso): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($sucesso); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form" action=""> 
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

             <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

        <a href="login.php" class="link-login">Já tem uma conta? Faça login</a>
    </div>
</body>
</html> 