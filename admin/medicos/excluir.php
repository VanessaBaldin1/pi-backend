<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\MedicoServico;

$medicoServico = new MedicoServico();
$id = $_GET['id'] ?? null;

if ($id) {
    $medicoServico->excluir($id);
}

header('Location: index.php');
exit; 