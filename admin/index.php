<?php
// Página principal da área administrativa

// Iniciar a sessão
session_start(); // Descomentado

// Incluir autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Lógica de verificação de sessão/login
if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php'); // Redirecionar para login se não estiver logado
    exit; // Importante sair para parar a execução do script
}

$titulo = "Painel Administrativo";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?> - ConectaConsulta Admin</title>
    <link rel="stylesheet" href="../style.css"> 
    <style>
        /* Estilos específicos se necessário */
        .admin-dashboard {
            padding: 2rem;
        }
        .welcome-message {
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            color: #333;
        }
        .admin-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        .section-card {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-decoration: none; /* Remover sublinhado de links */
            color: #333; /* Cor do texto */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .section-card:hover {
            transform: translateY(-5px); /* Efeito sutil ao passar o mouse */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        .section-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #007bff; /* Cor do ícone */
        }
        .section-card h3 {
            margin: 0;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container index">
            <div class="header-content">
                <div class="logo">
                    <h1><a href="../"><img src="../imagens/logotipo.png" alt=""></a></h1> 
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="pacientes"><i class="fas fa-users"></i> Pacientes</a></li>
                        <li><a href="medicos"><i class="fas fa-user-md"></i> Médicos</a></li>
                        <li><a href="consultas"><i class="fas fa-calendar-check"></i> Consultas</a></li>
                        <li><a href="exames"><i class="fas fa-notes-medical"></i> Exames</a></li>
                        
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="admin-dashboard">
            <h2><?php echo $titulo; ?></h2>
            <p class="welcome-message">Bem-vindo à área administrativa do ConectaConsulta.</p>

            <div class="admin-sections">
                
                <a href="pacientes/index.php" class="section-card">
                    <i class="fas fa-users"></i>
                    <h3>Gerenciar Pacientes</h3>
                </a>
                <a href="medicos/index.php" class="section-card">
                    <i class="fas fa-user-md"></i>
                    <h3>Gerenciar Médicos</h3>
                </a>
                <a href="consultas/index.php" class="section-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Gerenciar Consultas</h3>
                </a>
                <a href="exames/index.php" class="section-card">
                    <i class="fas fa-notes-medical"></i>
                    <h3>Gerenciar Exames</h3>
                </a>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <div class="logo">
                         <i class="fas fa-hospital-user"></i>
                         <h2>ConectaConsulta</h2>
                    </div>
                    <p>Painel Administrativo</p>
                </div>
                 <div class="footer-links">
                    <h4>Navegação Rápida</h4>
                    <ul>
                        <li><a href="pacientes">Pacientes</a></li>
                        <li><a href="medicos">Médicos</a></li>
                        <li><a href="consultas">Consultas</a></li>
                        <li><a href="exames">Exames</a></li>
                    </ul>
                </div>
                <!-- Adicionar informações de contato ou outros links do admin se necessário -->
                 <div class="footer-contact">
                    <h4>Suporte Admin</h4>
                    <p><i class="fas fa-envelope"></i> admin@conectaconsulta.com</p>
                    <p><i class="fas fa-phone"></i> (11) 9876-5432</p>
                </div>
            </div>
            <div class="footer-bottom">
                 <p>&copy; <?php echo date('Y'); ?> ConectaConsulta. Todos os direitos reservados (Admin).</p>
            </div>
        </div>
    </footer>
</body>
</html> 