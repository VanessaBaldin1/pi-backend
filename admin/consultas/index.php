<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\ConsultaServico;

$consultaServico = new ConsultaServico();
$consultas = $consultaServico->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Consultas</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Consultas</h1>
       <div class="direcao">
        <a href="../../index.php" class="btn-voltar">
            <i class="fas fa-arrow-left"></i>
            Voltar para o Início
        </a>
        
        <div class="actions">
            <a href="criar.php" class="btn btn-primary">Nova Consulta</a>
        </div>
</div> 
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?php echo $consulta['id']; ?></td>
                    <td><?php echo $consulta['paciente_nome']; ?></td>
                    <td><?php echo $consulta['medico_nome']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($consulta['data_consulta'])); ?></td>
                    <td><?php echo $consulta['hora_consulta']; ?></td>
                    <td><?php echo $consulta['status']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $consulta['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="excluir.php?id=<?php echo $consulta['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta consulta?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 