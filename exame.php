<?php
require_once __DIR__ . '/src/services/ExameService.php';

$exameService = new ExameService();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'preco' => $_POST['preco']
    ];
    
    $resultado = $exameService->criarExame($dados);
    $mensagem = $resultado['message'];
}

$exames = $exameService->listarExames();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exames - Conecta-Consulta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="logo">
            <img src="imagens/logotipo.png" alt="Logo Conecta-Consulta">
            Conecta-Consulta
        </div>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="atendimento.php">Atendimento</a></li>
            <li><a href="exame.php" class="active">Exame</a></li>
            <li><a href="medico.php">Médico</a></li>
            <li><a href="paciente.php">Paciente</a></li>
        </ul>
    </nav>
    <main>
        <section class="container">
            <h2>Cadastro de Exames</h2>
            <?php if ($mensagem): ?>
                <div class="mensagem"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <form class="formulario" method="POST">
                <label for="nome">Nome do Exame:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="3" required></textarea>

                <label for="preco">Preço (R$):</label>
                <input type="number" id="preco" name="preco" step="0.01" min="0" required>

                <button type="submit">Cadastrar Exame</button>
            </form>

            <h3>Exames Cadastrados</h3>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exames as $exame): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($exame['nome']); ?></td>
                        <td><?php echo htmlspecialchars($exame['descricao']); ?></td>
                        <td>R$ <?php echo number_format($exame['preco'], 2, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <img src="imagens/logotipo.png" alt="Logo Conecta-Consulta">
        <p>&copy; 2025 Conecta-Consulta. Todos os direitos reservados.</p>
        <p>Suporte: suporte@conectaconsulta.com</p>
    </footer>
</body>
</html> 