<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use ConectaConsulta\Services\ExameServico;

$exameServico = new ExameServico();

$id = $_GET['id'] ?? null;

if ($id) {
    $exameServico->excluir($id);
}

 