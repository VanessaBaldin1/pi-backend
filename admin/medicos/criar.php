<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\MedicoServico;

$medicoServico = new MedicoServico();
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dados = [
            'nome' => $_POST['nome'],
            'crm' => $_POST['crm'],
            'especialidade' => $_POST['especialidade'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone']
        ];

        if ($medicoServico->criar($dados)) {
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
    <title>Novo Médico</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Novo Médico</h1>
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
                <label for="crm">CRM:</label>
                <input type="text" id="crm" name="crm" value="<?php echo isset($_POST['crm']) ? htmlspecialchars($_POST['crm']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="especialidade">Especialidade:</label>
                <input type="text" id="especialidade" name="especialidade" value="<?php echo isset($_POST['especialidade']) ? htmlspecialchars($_POST['especialidade']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : ''; ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html> 