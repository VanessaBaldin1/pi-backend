<?php
require_once __DIR__ . '/src/services/AtendimentoService.php';

$atendimentoService = new AtendimentoService();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'paciente_id' => $_POST['paciente_id'],
        'medico_id' => $_POST['medico_id'],
        'data_hora' => $_POST['data'],
        'diagnostico' => $_POST['diagnostico'],
        'prescricao' => $_POST['prescricao'],
        'observacoes' => $_POST['observacoes']
    ];
    
    $resultado = $atendimentoService->criarAtendimento($dados);
    $mensagem = $resultado['message'];
}

$atendimentos = $atendimentoService->listarAtendimentos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atendimento - Conecta-Consulta</title>
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
      <li><a href="atendimento.php" class="active">Atendimento</a></li>
      <li><a href="exame.php">Exame</a></li>
      <li><a href="medico.php">Médico</a></li>
      <li><a href="paciente.php">Paciente</a></li>
    </ul>
  </nav>
  <main>
    <section class="container">
      <h2>Atendimento Médico</h2>
      <?php if ($mensagem): ?>
        <div class="mensagem"><?php echo $mensagem; ?></div>
      <?php endif; ?>
      <form class="formulario" method="POST">
        <label for="paciente_id">Paciente:</label>
        <select id="paciente_id" name="paciente_id" required>
          <option value="">Selecione um paciente</option>
          <!-- Aqui você pode adicionar um loop para carregar os pacientes do banco -->
        </select>
        <label for="medico_id">Médico:</label>
        <select id="medico_id" name="medico_id" required>
          <option value="">Selecione um médico</option>
          <!-- Aqui você pode adicionar um loop para carregar os médicos do banco -->
        </select>
        <label for="data">Data e Hora:</label>
        <input type="datetime-local" id="data" name="data" required>
        <label for="diagnostico">Diagnóstico:</label>
        <textarea id="diagnostico" name="diagnostico" rows="2" placeholder="Descreva o diagnóstico"></textarea>
        <label for="prescricao">Prescrição:</label>
        <textarea id="prescricao" name="prescricao" rows="2" placeholder="Prescrição médica"></textarea>
        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes" rows="2" placeholder="Observações adicionais"></textarea>
        <button type="submit">Salvar Atendimento</button>
      </form>

      <h3>Atendimentos Recentes</h3>
      <table class="tabela">
        <thead>
          <tr>
            <th>Data/Hora</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Diagnóstico</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($atendimentos as $atendimento): ?>
          <tr>
            <td><?php echo date('d/m/Y H:i', strtotime($atendimento['data_hora'])); ?></td>
            <td><?php echo htmlspecialchars($atendimento['paciente_nome']); ?></td>
            <td><?php echo htmlspecialchars($atendimento['medico_nome']); ?></td>
            <td><?php echo htmlspecialchars($atendimento['diagnostico']); ?></td>
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