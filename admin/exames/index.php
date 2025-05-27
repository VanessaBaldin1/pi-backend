<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\ExameServico;

$exameServico = new ExameServico();
$exames = $exameServico->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Exames</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Exames</h1>
        <div class="direcao">
        <a href="../../index.php" class="btn-voltar">
            <i class="fas fa-arrow-left"></i>
            Voltar para o Início
        </a>
        
        <div class="actions">
            <a href="criar.php" class="btn btn-primary">Novo Exame</a>
        </div>
        </div> 
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Resultado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exames as $exame): ?>
                <tr>
                    <td><?php echo $exame['id']; ?></td>
                    <td><?php echo $exame['paciente_nome']; ?></td>
                    <td><?php echo $exame['medico_nome']; ?></td>
                    <td><?php echo $exame['tipo_exame']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($exame['data_exame'])); ?></td>
                    <td><?php echo $exame['resultado']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $exame['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="excluir.php?id=<?php echo $exame['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este exame?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 