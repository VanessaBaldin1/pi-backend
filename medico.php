<?php
require_once __DIR__ . '/src/services/MedicoService.php';

$medicoService = new MedicoService();
$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'criar':
                $dados = [
                    'nome' => $_POST['nome'],
                    'crm' => $_POST['crm'],
                    'especialidade' => $_POST['especialidade'],
                    'telefone' => $_POST['telefone'],
                    'email' => $_POST['email']
                ];
                $resultado = $medicoService->criarMedico($dados);
                break;
            
            case 'atualizar':
                $dados = [
                    'id' => $_POST['id'],
                    'nome' => $_POST['nome'],
                    'crm' => $_POST['crm'],
                    'especialidade' => $_POST['especialidade'],
                    'telefone' => $_POST['telefone'],
                    'email' => $_POST['email']
                ];
                $resultado = $medicoService->atualizarMedico($dados);
                break;
            
            case 'excluir':
                $resultado = $medicoService->excluirMedico($_POST['id']);
                break;
        }
        
        $mensagem = $resultado['message'];
        $tipoMensagem = $resultado['status'];
    }
}

$medicos = $medicoService->listarMedicos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos - Conecta-Consulta</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <li><a href="exame.php">Exame</a></li>
            <li><a href="medico.php" class="active">Médico</a></li>
            <li><a href="paciente.php">Paciente</a></li>
        </ul>
    </nav>
    <main>
        <section class="container">
            <h2>Cadastro de Médicos</h2>
            
            <?php if ($mensagem): ?>
                <div class="mensagem <?php echo $tipoMensagem; ?>">
                    <?php echo $mensagem; ?>
                    <button class="fechar-mensagem">&times;</button>
                </div>
            <?php endif; ?>

            <div class="card">
                <form class="formulario" method="POST" id="formMedico">
                    <input type="hidden" name="acao" value="criar">
                    <input type="hidden" name="id" id="id" value="">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nome">Nome Completo:</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="crm">CRM:</label>
                            <input type="text" id="crm" name="crm" required>
                        </div>

                        <div class="form-group">
                            <label for="especialidade">Especialidade:</label>
                            <select id="especialidade" name="especialidade" required>
                                <option value="">Selecione uma especialidade</option>
                                <option value="Acupuntura">Acupuntura</option>
                                <option value="Alergia e Imunologia">Alergia e Imunologia</option>
                                <option value="Anestesiologia">Anestesiologia</option>
                                <option value="Angiologia">Angiologia</option>
                                <option value="Cardiologia">Cardiologia</option>
                                <option value="Cirurgia Cardiovascular">Cirurgia Cardiovascular</option>
                                <option value="Cirurgia Geral">Cirurgia Geral</option>
                                <option value="Cirurgia Pediátrica">Cirurgia Pediátrica</option>
                                <option value="Cirurgia Plástica">Cirurgia Plástica</option>
                                <option value="Clínica Médica">Clínica Médica</option>
                                <option value="Dermatologia">Dermatologia</option>
                                <option value="Endocrinologia">Endocrinologia</option>
                                <option value="Gastroenterologia">Gastroenterologia</option>
                                <option value="Genética Médica">Genética Médica</option>
                                <option value="Geriatria">Geriatria</option>
                                <option value="Ginecologia e Obstetrícia">Ginecologia e Obstetrícia</option>
                                <option value="Hematologia">Hematologia</option>
                                <option value="Homeopatia">Homeopatia</option>
                                <option value="Infectologia">Infectologia</option>
                                <option value="Mastologia">Mastologia</option>
                                <option value="Medicina de Família">Medicina de Família</option>
                                <option value="Medicina do Trabalho">Medicina do Trabalho</option>
                                <option value="Medicina Esportiva">Medicina Esportiva</option>
                                <option value="Medicina Física e Reabilitação">Medicina Física e Reabilitação</option>
                                <option value="Medicina Intensiva">Medicina Intensiva</option>
                                <option value="Medicina Legal">Medicina Legal</option>
                                <option value="Medicina Nuclear">Medicina Nuclear</option>
                                <option value="Medicina Preventiva">Medicina Preventiva</option>
                                <option value="Nefrologia">Nefrologia</option>
                                <option value="Neurocirurgia">Neurocirurgia</option>
                                <option value="Neurologia">Neurologia</option>
                                <option value="Nutrologia">Nutrologia</option>
                                <option value="Oftalmologia">Oftalmologia</option>
                                <option value="Oncologia">Oncologia</option>
                                <option value="Ortopedia e Traumatologia">Ortopedia e Traumatologia</option>
                                <option value="Otorrinolaringologia">Otorrinolaringologia</option>
                                <option value="Patologia">Patologia</option>
                                <option value="Pediatria">Pediatria</option>
                                <option value="Pneumologia">Pneumologia</option>
                                <option value="Psiquiatria">Psiquiatria</option>
                                <option value="Radiologia">Radiologia</option>
                                <option value="Radioterapia">Radioterapia</option>
                                <option value="Reumatologia">Reumatologia</option>
                                <option value="Urologia">Urologia</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" required>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email">
                        </div>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn-primary">Cadastrar Médico</button>
                        <button type="button" class="btn-secondary" onclick="limparFormulario()">Limpar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h3>Médicos Cadastrados</h3>
                <div class="table-responsive">
                    <table class="tabela">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CRM</th>
                                <th>Especialidade</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medicos as $medico): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($medico['nome']); ?></td>
                                <td><?php echo htmlspecialchars($medico['crm']); ?></td>
                                <td><?php echo htmlspecialchars($medico['especialidade']); ?></td>
                                <td><?php echo htmlspecialchars($medico['telefone']); ?></td>
                                <td><?php echo htmlspecialchars($medico['email']); ?></td>
                                <td class="acoes">
                                    <button class="btn-icon" onclick="editarMedico(<?php echo htmlspecialchars(json_encode($medico)); ?>)" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon btn-danger" onclick="confirmarExclusao(<?php echo $medico['id']; ?>, '<?php echo htmlspecialchars($medico['nome']); ?>')" title="Excluir">
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
            <p>Tem certeza que deseja excluir o médico <span id="nomeMedicoExclusao"></span>?</p>
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
        // Função para editar médico
        function editarMedico(medico) {
            document.getElementById('id').value = medico.id;
            document.getElementById('nome').value = medico.nome;
            document.getElementById('crm').value = medico.crm;
            document.getElementById('especialidade').value = medico.especialidade;
            document.getElementById('telefone').value = medico.telefone;
            document.getElementById('email').value = medico.email;
            
            document.querySelector('input[name="acao"]').value = 'atualizar';
            document.querySelector('.btn-primary').textContent = 'Atualizar Médico';
            
            // Scroll suave até o formulário
            document.querySelector('.formulario').scrollIntoView({ behavior: 'smooth' });
        }

        // Função para limpar formulário
        function limparFormulario() {
            document.getElementById('formMedico').reset();
            document.getElementById('id').value = '';
            document.querySelector('input[name="acao"]').value = 'criar';
            document.querySelector('.btn-primary').textContent = 'Cadastrar Médico';
        }

        // Função para confirmar exclusão
        function confirmarExclusao(id, nome) {
            document.getElementById('idExclusao').value = id;
            document.getElementById('nomeMedicoExclusao').textContent = nome;
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