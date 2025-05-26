<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\ConsultaServico;

$consultaServico = new ConsultaServico();

$id = $_GET['id'] ?? null;

if ($id) {
    $consultaServico->excluir($id);
}

header('Location: index.php');
exit; 