<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\PacienteServico;

$pacienteServico = new PacienteServico();
$pacientes = $pacienteServico->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pacientes</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Pacientes</h1>
        
        <div class="actions">
            <a href="criar.php" class="btn btn-primary">Novo Paciente</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente): ?>
                <tr>
                    <td><?php echo $paciente['id']; ?></td>
                    <td><?php echo $paciente['nome']; ?></td>
                    <td><?php echo $paciente['cpf']; ?></td>
                    <td><?php echo $paciente['email']; ?></td>
                    <td><?php echo $paciente['telefone']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($paciente['data_nascimento'])); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $paciente['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="excluir.php?id=<?php echo $paciente['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este paciente?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 