<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\MedicoServico;

$medicoServico = new MedicoServico();
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$medico = $medicoServico->buscarPorId($id);

if (!$medico) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'crm' => $_POST['crm'],
        'especialidade' => $_POST['especialidade'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone']
    ];

    if ($medicoServico->atualizar($id, $dados)) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Médico</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Editar Médico</h1>
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
                <input type="text" id="nome" name="nome" value="<?php echo $medico['nome']; ?>" required>
            </div>

            <div class="form-group">
                <label for="crm">CRM:</label>
                <input type="text" id="crm" name="crm" value="<?php echo $medico['crm']; ?>" required>
            </div>

            <div class="form-group">
                <label for="especialidade">Especialidade:</label>
                <input type="text" id="especialidade" name="especialidade" value="<?php echo $medico['especialidade']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $medico['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo $medico['telefone']; ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html> 