<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\PacienteServico;

$pacienteServico = new PacienteServico();
$id = $_GET['id'] ?? null;

if ($id) {
    $pacienteServico->excluir($id);
}

header('Location: index.php');
exit; 