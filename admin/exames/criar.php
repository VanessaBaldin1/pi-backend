<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\ExameServico;
use ConectaConsulta\Services\PacienteServico;
use ConectaConsulta\Services\MedicoServico;

$exameServico = new ExameServico();
$pacienteServico = new PacienteServico();
$medicoServico = new MedicoServico();

$pacientes = $pacienteServico->listar();
$medicos = $medicoServico->listar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'paciente_id' => $_POST['paciente_id'],
        'medico_id' => $_POST['medico_id'],
        'tipo_exame' => $_POST['tipo_exame'],
        'data_exame' => $_POST['data_exame'],
        'resultado' => $_POST['resultado'],
        'observacoes' => $_POST['observacoes']
    ];

    if ($exameServico->criar($dados)) {
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
    <title>Novo Exame</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Novo Exame</h1>
        
        <form method="POST" class="form">
            <div class="form-group">
                <label for="paciente_id">Paciente:</label>
                <select id="paciente_id" name="paciente_id" required>
                    <option value="">Selecione um paciente</option>
                    <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?php echo $paciente['id']; ?>">
                        <?php echo $paciente['nome']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="medico_id">Médico:</label>
                <select id="medico_id" name="medico_id" required>
                    <option value="">Selecione um médico</option>
                    <?php foreach ($medicos as $medico): ?>
                    <option value="<?php echo $medico['id']; ?>">
                        <?php echo $medico['nome']; ?> - <?php echo $medico['especialidade']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_exame">Tipo do Exame:</label>
                <input type="text" id="tipo_exame" name="tipo_exame" required>
            </div>

            <div class="form-group">
                <label for="data_exame">Data do Exame:</label>
                <input type="date" id="data_exame" name="data_exame" required>
            </div>

            <div class="form-group">
                <label for="resultado">Resultado:</label>
                <textarea id="resultado" name="resultado" required></textarea>
            </div>

            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea id="observacoes" name="observacoes"></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html> 