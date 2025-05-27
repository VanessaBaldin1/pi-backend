<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\PacienteServico;

$pacienteServico = new PacienteServico();
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dados = [
            'nome' => $_POST['nome'],
            'cpf' => $_POST['cpf'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'data_nascimento' => $_POST['data_nascimento']
        ];

        if ($pacienteServico->criar($dados)) {
            header('Location: index.php');
            exit;
        }
    } catch (\Exception $e) {
        $erro = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Paciente</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
       <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Novo Paciente</h1>
            <a href="index.php" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Voltar</a>
        </div>
        
        <?php if ($erro): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo isset($_POST['data_nascimento']) ? htmlspecialchars($_POST['data_nascimento']) : ''; ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html> 