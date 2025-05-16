<?php
require_once __DIR__ . '/src/Models/Exame.php';
require_once __DIR__ . '/src/Services/ExameService.php';
require_once __DIR__ . '/src/config/Database.php';

$database = new Database();
$db = $database->getConnection();

$exameService = new ExameService($db);

$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'criar':
                $dados = [
                    'paciente_id' => $_POST['paciente_id'],
                    'medico_id' => $_POST['medico_id'],
                    'tipo_exame' => $_POST['tipo_exame'],
                    'data_exame' => $_POST['data_exame'],
                    'hora_exame' => $_POST['hora_exame'],
                    'resultado' => $_POST['resultado'],
                    'status' => $_POST['status']
                ];
                $resultado = $exameService->criarExame($dados);
                break;

            case 'atualizar':
                $dados = [
                    'id' => $_POST['id'],
                    'paciente_id' => $_POST['paciente_id'],
                    'medico_id' => $_POST['medico_id'],
                    'tipo_exame' => $_POST['tipo_exame'],
                    'data_exame' => $_POST['data_exame'],
                    'hora_exame' => $_POST['hora_exame'],
                    'resultado' => $_POST['resultado'],
                    'status' => $_POST['status']
                ];
                $resultado = $exameService->atualizarExame($dados);
                break;

            case 'excluir':
                $resultado = $exameService->excluirExame($_POST['id']);
                break;
        }
        
        $mensagem = $resultado['message'];
        $tipoMensagem = $resultado['status'];
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            margin: 0 2px;
            font-size: 1.1em;
            color: #2196F3;
            transition: color 0.3s;
        }
        .btn-icon:hover {
            color: #1976D2;
        }
        .btn-icon.btn-danger {
            color: #f44336;
        }
        .btn-icon.btn-danger:hover {
            color: #d32f2f;
        }
        .acoes {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 90%;
            max-width: 500px;
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
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
            <h2>Agendamento de Exames</h2>

            <?php if ($mensagem): ?>
                <div class="mensagem <?php echo $tipoMensagem; ?>">
                    <?php echo $mensagem; ?>
                    <button class="fechar-mensagem">&times;</button>
                </div>
            <?php endif; ?>

            <div class="card">
                <form class="formulario" method="POST" id="formExame">
                    <input type="hidden" name="acao" value="criar">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="paciente_id">Paciente:</label>
                            <input type="text" id="paciente_id" name="paciente_id" required placeholder="Digite o nome do paciente">
                        </div>

                        <div class="form-group">
                            <label for="medico_id">Médico:</label>
                            <input type="text" id="medico_id" name="medico_id" required placeholder="Digite o nome do médico">
                        </div>

                        <div class="form-group">
                            <label for="tipo_exame">Tipo de Exame:</label>
                            <input type="text" id="tipo_exame" name="tipo_exame" required placeholder="Digite o tipo do exame">
                        </div>

                        <div class="form-group">
                            <label for="data_exame">Data do Exame:</label>
                            <input type="date" id="data_exame" name="data_exame" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_exame">Hora do Exame:</label>
                            <input type="time" id="hora_exame" name="hora_exame" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" required>
                                <option value="">Selecione o status</option>
                                <option value="agendado">Agendado</option>
                                <option value="realizado">Realizado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="resultado">Resultado:</label>
                            <textarea id="resultado" name="resultado" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn-primary">Agendar Exame</button>
                        <button type="button" class="btn-secondary" onclick="limparFormulario()">Limpar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h3>Exames Agendados</h3>
                <div class="table-responsive">
                    <table class="tabela">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Status</th>
                                <th>Resultado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($exames as $exame): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($exame['nome_paciente']); ?></td>
                                    <td><?php echo htmlspecialchars($exame['nome_medico']); ?></td>
                                    <td><?php echo htmlspecialchars($exame['tipo_exame']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($exame['data_exame'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($exame['hora_exame'])); ?></td>
                                    <td><?php echo htmlspecialchars($exame['status']); ?></td>
                                    <td><?php echo htmlspecialchars($exame['resultado']); ?></td>
                                    <td class="acoes">
                                        <button class="btn-icon" onclick="editarExame(<?php echo htmlspecialchars(json_encode($exame)); ?>)" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon btn-danger" onclick="confirmarExclusao(<?php echo $exame['id']; ?>, '<?php echo htmlspecialchars($exame['nome_paciente']); ?>')" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal de Confirmação de Exclusão -->
    <div id="modalExclusao" class="modal">
        <div class="modal-content">
            <h3>Confirmar Exclusão</h3>
            <p>Tem certeza que deseja excluir o exame do paciente <span id="nomePacienteExclusao"></span>?</p>
            <form method="POST">
                <input type="hidden" name="acao" value="excluir">
                <input type="hidden" name="id" id="idExclusao">
                <div class="modal-buttons">
                    <button type="submit" class="btn-danger">Confirmar Exclusão</button>
                    <button type="button" class="btn-secondary" onclick="fecharModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <img src="imagens/logotipo.png" alt="Logo Conecta-Consulta">
        <p>&copy; 2025 Conecta-Consulta. Todos os direitos reservados.</p>
        <p>Suporte: suporte@conectaconsulta.com</p>
    </footer>

    <script>
        // Função para editar exame
        function editarExame(exame) {
            document.getElementById('id').value = exame.id;
            document.getElementById('paciente_id').value = exame.nome_paciente;
            document.getElementById('medico_id').value = exame.nome_medico;
            document.getElementById('tipo_exame').value = exame.tipo_exame;
            document.getElementById('data_exame').value = exame.data_exame;
            document.getElementById('hora_exame').value = exame.hora_exame;
            document.getElementById('status').value = exame.status;
            document.getElementById('resultado').value = exame.resultado;
            
            document.querySelector('input[name="acao"]').value = 'atualizar';
            document.querySelector('.btn-primary').textContent = 'Atualizar Exame';
            
            // Scroll suave até o formulário
            document.querySelector('.formulario').scrollIntoView({ behavior: 'smooth' });
        }

        // Função para limpar formulário
        function limparFormulario() {
            document.getElementById('formExame').reset();
            document.getElementById('id').value = '';
            document.querySelector('input[name="acao"]').value = 'criar';
            document.querySelector('.btn-primary').textContent = 'Agendar Exame';
        }

        // Função para confirmar exclusão
        function confirmarExclusao(id, nome) {
            document.getElementById('idExclusao').value = id;
            document.getElementById('nomePacienteExclusao').textContent = nome;
            document.getElementById('modalExclusao').style.display = 'flex';
        }

        // Função para fechar modal
        function fecharModal() {
            document.getElementById('modalExclusao').style.display = 'none';
        }

        // Fechar mensagens de alerta
        document.querySelectorAll('.fechar-mensagem').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });

        // Fechar modal ao clicar fora
        window.onclick = function(event) {
            if (event.target == document.getElementById('modalExclusao')) {
                fecharModal();
            }
        }
    </script>
</body>
</html> 