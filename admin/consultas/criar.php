<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\ConsultaServico;
use ConectaConsulta\Services\PacienteServico;
use ConectaConsulta\Services\MedicoServico;

$consultaServico = new ConsultaServico();
$pacienteServico = new PacienteServico();
$medicoServico = new MedicoServico();

$pacientes = $pacienteServico->listar();
$medicos = $medicoServico->listar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'paciente_id' => $_POST['paciente_id'],
        'medico_id' => $_POST['medico_id'],
        'data_consulta' => $_POST['data_consulta'],
        'hora_consulta' => $_POST['hora_consulta'],
        'status' => $_POST['status'],
        'observacoes' => $_POST['observacoes']
    ];

    if ($consultaServico->criar($dados)) {
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
    <title>Nova Consulta</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Nova Consulta</h1>
         <a href="../../index.php"> <button type="submit" class="btn " >Home</button></a>
        
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
                <label for="data_consulta">Data da Consulta:</label>
                <input type="date" id="data_consulta" name="data_consulta" required>
                 
            </div>

            <div class="form-group">
                <label for="hora_consulta">Hora da Consulta:</label>
                <input type="time" id="hora_consulta" name="hora_consulta" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="agendada">Agendada</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="realizada">Realizada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>

            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea id="observacoes" name="observacoes"></textarea>
            </div>

            <div class="form-actions" >
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button><a href="index.php" class="btn btn-secondary">Cancelar</a></button>
            </div>



        </form>
    </div>
</body>
</html> 