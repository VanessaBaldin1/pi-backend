<?php
require_once __DIR__ . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaConsulta - Sistema de Gerenciamento de Consultas Médicas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="main-header">
        <div class="container index">
            <div class="header-content">
                <div class="logo" >
                   
                    
                    <!-- <i class="fas fa-hospital-user"></i> -->
                    <h1><a href=""><img src="imagens/logotipo.png" alt=""></a></h1>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="admin/pacientes"><i class="fas fa-users"></i> Pacientes</a></li>
                        <li><a href="admin/medicos"><i class="fas fa-user-md"></i> Médicos</a></li>
                        <li><a href="admin/consultas"><i class="fas fa-calendar-check"></i> Consultas</a></li>
                        <li><a href="admin/exames"><i class="fas fa-notes-medical"></i> Exames</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="hero">
            <!-- <div class="container-1"> -->
                
                <section class="hero-content" >
                    
                    <h2>Bem-vindo ao ConectaConsulta</h2>
                    <p>Gerencie suas consultas médicas de forma simples e eficiente</p>
                </section>
            <!-- </div> -->
        </div>

        
            <section class="features">
                <div class="container">
                    <h3 >Nossas Funcionalidades</h3>
                    <div>
                        <div class="feature-grid">
                            <div class="col">
                                <div class="feature-card">
                                    <div class="feature-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h4>Gestão de Pacientes</h4>
                                    <p>Cadastre e gerencie seus pacientes de forma organizada</p>
                                    <ul class="feature-list">
                                        <li><i class="fas fa-check"></i> Cadastro completo</li>
                                        <li><i class="fas fa-check"></i> Histórico médico</li>
                                        <li><i class="fas fa-check"></i> Prontuário digital</li>
                                    </ul>
                                    <a href="admin/pacientes" class="btn btn-primary">Acessar</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="feature-card">
                                    <div class="feature-icon">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <h4>Gestão de Médicos</h4>
                                    <p>Controle sua equipe médica e especialidades</p>
                                    <ul class="feature-list">
                                        <li><i class="fas fa-check"></i> Cadastro profissional</li>
                                        <li><i class="fas fa-check"></i> Especialidades</li>
                                        <li><i class="fas fa-check"></i> Agenda individual</li>
                                    </ul>
                                    <a href="admin/medicos" class="btn btn-primary">Acessar</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="feature-card">
                                    <div class="feature-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <h4>Agendamento</h4>
                                    <p>Sistema completo de agendamento de consultas</p>
                                    <ul class="feature-list">
                                        <li><i class="fas fa-check"></i> Agenda online</li>
                                        <li><i class="fas fa-check"></i> Confirmações</li>
                                        <li><i class="fas fa-check"></i> Lembretes</li>
                                    </ul>
                                    <a href="admin/consultas" class="btn btn-primary">Acessar</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="feature-card">
                                    <div class="feature-icon">
                                        <i class="fas fa-notes-medical"></i>
                                    </div>
                                    <h4>Exames</h4>
                                    <p>Controle completo de exames e resultados</p>
                                    <ul class="feature-list">
                                        <li><i class="fas fa-check"></i> Registro de exames</li>
                                        <li><i class="fas fa-check"></i> Resultados online</li>
                                        <li><i class="fas fa-check"></i> Histórico completo</li>
                                    </ul>
                                    <a href="admin/exames" class="btn btn-primary">Acessar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        

        <section class="cta">
            <div class="container">
                <div class="cta-content">
                    <h3>Comece a usar agora mesmo</h3>
                    <p>Simplifique a gestão da sua clínica médica</p>
                    <a href="admin/consultas" class="btn btn-large">Agendar Consulta</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <div class="logo">
                        <i class="fas fa-hospital-user"></i>
                        <h2>ConectaConsulta</h2>
                    </div>
                    <p>Sistema de gerenciamento de consultas médicas</p>
                </div>
                <div class="footer-links">
                    <h4>Links Rápidos</h4>
                    <ul>
                        <li><a href="admin/pacientes">Pacientes</a></li>
                        <li><a href="admin/medicos">Médicos</a></li>
                        <li><a href="admin/consultas">Consultas</a></li>
                        <li><a href="admin/exames">Exames</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Contato</h4>
                    <p><i class="fas fa-envelope"></i> contato@conectaconsulta.com</p>
                    <p><i class="fas fa-phone"></i> (11) 1234-5678</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> ConectaConsulta. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>