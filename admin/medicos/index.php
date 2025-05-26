<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\MedicoServico;

$medicoServico = new MedicoServico();
$medicos = $medicoServico->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Médicos</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Médicos</h1>
        
        <a href="../../index.php" class="btn-voltar">
            <i class="fas fa-arrow-left"></i>
            Voltar para o Início
        </a>
        
        <div class="actions">
            <a href="criar.php" class="btn btn-primary">Novo Médico</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CRM</th>
                    <th>Especialidade</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicos as $medico): ?>
                <tr>
                    <td><?php echo $medico['id']; ?></td>
                    <td><?php echo $medico['nome']; ?></td>
                    <td><?php echo $medico['crm']; ?></td>
                    <td><?php echo $medico['especialidade']; ?></td>
                    <td><?php echo $medico['email']; ?></td>
                    <td><?php echo $medico['telefone']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $medico['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="excluir.php?id=<?php echo $medico['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este médico?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 