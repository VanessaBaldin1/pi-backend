<?php
require_once __DIR__ . '/src/services/AtendimentoService.php';
require_once __DIR__ . '/src/services/PacienteService.php';
require_once __DIR__ . '/src/services/MedicoService.php';
require_once __DIR__ . '/src/services/ExameService.php';

$pdo = new PDO('mysql:host=localhost;dbname=seu_banco_de_dados', 'seu_usuario', 'sua_senha');
$atendimentoService = new AtendimentoService($pdo);
$pacienteService = new PacienteService();
$medicoService = new MedicoService();
$exameService = new ExameService();

$atendimentos = $atendimentoService->listarAtendimentos();
$pacientes = $pacienteService->listarPacientes();
$medicos = $medicoService->listarMedicos();
$exames = $exameService->listarExames();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Conecta-Consulta</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav>
    <div class="logo">
      <img src="imagens/logotipo.png" alt="Logo Conecta-Consulta">
      Conecta-Consulta
    </div>
    <ul>
      <li><a href="index.php" class="active">Início</a></li>
      <li><a href="atendimento.php">Atendimento</a></li>
      <li><a href="exame.php">Exame</a></li>
      <li><a href="medico.php">Médico</a></li>
      <li><a href="paciente.php">Paciente</a></li>
    </ul>
  </nav>
  <main>
    <section class="container">
      <h2>Dashboard</h2>
      
      <div class="dashboard-grid">
        <div class="dashboard-card">
          <h3>Atendimentos</h3>
          <p class="numero"><?php echo count($atendimentos); ?></p>
          <a href="atendimento.php" class="btn-link">Ver todos</a>
        </div>

        <div class="dashboard-card">
          <h3>Pacientes</h3>
          <p class="numero"><?php echo count($pacientes); ?></p>
          <a href="paciente.php" class="btn-link">Ver todos</a>
        </div>

        <div class="dashboard-card">
          <h3>Médicos</h3>
          <p class="numero"><?php echo count($medicos); ?></p>
          <a href="medico.php" class="btn-link">Ver todos</a>
        </div>

        <div class="dashboard-card">
          <h3>Exames</h3>
          <p class="numero"><?php echo count($exames); ?></p>
          <a href="exame.php" class="btn-link">Ver todos</a>
        </div>
      </div>

      <h3>Últimos Atendimentos</h3>
      <table class="tabela">
        <thead>
          <tr>
            <th>Data</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($atendimentos, 0, 5) as $atendimento): ?>
          <tr>
            <td><?php echo date('d/m/Y', strtotime($atendimento['data'])); ?></td>
            <td><?php echo htmlspecialchars($atendimento['paciente_nome']); ?></td>
            <td><?php echo htmlspecialchars($atendimento['medico_nome']); ?></td>
            <td><?php echo htmlspecialchars($atendimento['status']); ?></td>
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