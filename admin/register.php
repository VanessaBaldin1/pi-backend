<?php
// Iniciar a sessão PHP para futuras funcionalidades como mensagens flash
// session_start(); // Descomente esta linha se precisar usar sessões (por exemplo, para mensagens flash ou redirecionamento)

// Inicializar variáveis para evitar warnings
$erro = null;
$sucesso = null;

// Incluir autoload do Composer se estiver usando (ajuste o caminho se necessário)
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir o serviço de administrador quando ele for criado
// use ConectaConsulta\Services\AdminServico;

use ConectaConsulta\Models\Admin; // Usar o Admin Model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter e filtrar os dados do formulário
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? ''; // Senhas não devem ser filtradas diretamente com sanitize filters
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // ### Lógica de Validação Básica (Antes de interagir com o BD) ###
    if (!$email) {
        $erro = 'Por favor, insira um email válido.';
    } elseif (empty($senha) || empty($confirmar_senha)) {
        $erro = 'Por favor, preencha todos os campos de senha.';
    } elseif ($senha !== $confirmar_senha) {
        $erro = 'As senhas não coincidem.';
    } elseif (strlen($senha) < 6) { // Exemplo: senha mínima de 6 caracteres
        $erro = 'A senha deve ter pelo menos 6 caracteres.';
    } else {
        // ### Lógica de Cadastro Seguro ###
        // 1. Verificar unicidade do email no banco de dados. (Feito no método criar do Model)
        // 2. Criptografar a senha (usar password_hash()!).
        // 3. Salvar o email e a senha criptografada em uma tabela de administradores.
        // 4. Tratar erros específicos do banco de dados (ex: email duplicado).

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
                    // Opcional: Redirecionar para a página de login após sucesso
                    // header('Location: login.php');
                    // exit;
                } else {
                    // Se o criar retornar false por algum motivo (embora o catch no Model já trate 23000)
                    $erro = 'Erro ao cadastrar administrador.';
                }
            }
        } catch (\PDOException $e) {
            // Tratar erros específicos do banco de dados que podem ocorrer aqui
            // (embora o tratamento de 23000 já esteja no Model, é bom ter um fallback)
            if ($e->getCode() === '23000') {
                 $erro = 'Este email já está cadastrado.';
            } else {
                 $erro = 'Ocorreu um erro no banco de dados ao tentar cadastrar.<br>Detalhes: ' . $e->getMessage();
                 // Logar o erro real em ambiente de desenvolvimento:
                 // error_log('Database Error during registration: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            // Capturar outras exceções gerais
            $erro = 'Ocorreu um erro inesperado durante o cadastro: ' . $e->getMessage();
             // Logar o erro real em ambiente de desenvolvimento:
             // error_log('General Error during registration: ' . $e->getMessage());
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
    <!-- Estilos CSS embutidos para garantir que a página seja exibida corretamente -->
    <style>
        body {
            font-family: 'Arial', sans-serif; /* Fonte genérica */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4; /* Cor de fundo clara */
            margin: 0;
            padding: 20px; /* Adiciona um pouco de padding para telas pequenas */
            box-sizing: border-box;
        }
        .register-container {
            background-color: #fff; /* Fundo branco para o container */
            padding: 2rem; /* Espaçamento interno */
            border-radius: 8px; /* Cantos arredondados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 100%;
            max-width: 450px; /* Largura máxima */
            text-align: center; /* Centraliza o conteúdo de texto */
        }
        .register-container h1 {
            margin-bottom: 1.5rem; /* Espaço abaixo do título */
            color: #333; /* Cor do título */
            font-size: 1.8rem; /* Tamanho da fonte do título */
        }
        .form-group {
            margin-bottom: 1rem; /* Espaço entre grupos de formulário */
            text-align: left; /* Alinha rótulos e inputs à esquerda */
        }
        .form-group label {
            display: block; /* Rótulo em sua própria linha */
            margin-bottom: 0.5rem; /* Espaço abaixo do rótulo */
            font-weight: bold; /* Texto do rótulo em negrito */
            color: #555; /* Cor do rótulo */
            font-size: 0.9rem; /* Tamanho da fonte do rótulo */
        }
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="text"] { /* Adicionado text caso mude o tipo de input do usuário */
            width: 100%; /* Ocupa a largura total do contêiner pai */
            padding: 0.8rem; /* Espaçamento interno nos inputs */
            border: 1px solid #ccc; /* Borda padrão */
            border-radius: 4px; /* Cantos arredondados para inputs */
            box-sizing: border-box; /* Inclui padding e border no tamanho total */
            font-size: 1rem; /* Tamanho da fonte do input */
        }
        .btn-primary {
            background-color: #007bff; /* Cor de fundo azul */
            color: white; /* Texto branco */
            padding: 0.8rem 1.5rem; /* Espaçamento interno do botão */
            border: none; /* Remove a borda padrão */
            border-radius: 4px; /* Cantos arredondados */
            cursor: pointer; /* Cursor de mãozinha ao passar por cima */
            font-size: 1rem; /* Tamanho da fonte do botão */
            margin-top: 1rem; /* Espaço acima do botão */
            transition: background-color 0.3s ease; /* Transição suave na cor de fundo */
            width: 100%; /* Botão ocupa a largura total */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Cor mais escura no hover */
        }
        /* Estilos para mensagens de alerta (erro e sucesso) */
        .alert {
            padding: 0.75rem 1.25rem; /* Espaçamento interno */
            margin-bottom: 1rem; /* Espaço abaixo do alerta */
            border: 1px solid transparent; /* Borda transparente por padrão */
            border-radius: 0.25rem; /* Cantos arredondados */
            text-align: left; /* Alinhar texto à esquerda */
            font-size: 0.9rem; /* Tamanho da fonte do alerta */
        }
        .alert-danger {
            color: #721c24; /* Cor do texto vermelho escuro */
            background-color: #f8d7da; /* Cor de fundo rosa claro */
            border-color: #f5c6cb; /* Cor da borda rosa */
        }
         .alert-success {
            color: #155724; /* Cor do texto verde escuro */
            background-color: #d4edda; /* Cor de fundo verde claro */
            border-color: #c3e6cb; /* Cor da borda verde */
        }
        .link-login {
            display: block; /* Link em sua própria linha */
            margin-top: 1rem; /* Espaço acima do link */
            color: #007bff; /* Cor azul para o link */
            text-decoration: none; /* Remove sublinhado padrão */
            font-size: 0.9rem; /* Tamanho da fonte do link */
        }
        .link-login:hover {
            text-decoration: underline; /* Adiciona sublinhado no hover */
        }
    </style>
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

        <form method="POST" class="form" action=""> <!-- action="" envia para a mesma página -->
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