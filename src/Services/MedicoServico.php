<?php
namespace ConectaConsulta\Services;

use ConectaConsulta\Models\Medicos;
use PDO;

class MedicoServico {
    private $model;

    public function __construct() {
        $this->model = new Medicos();
    }

    public function listar() {
        return $this->model->listar();
    }

    public function buscarPorId($id) {
        return $this->model->buscarPorId($id);
    }

    public function criar($dados) {
        return $this->model->criar($dados);
    }

    public function atualizar($id, $dados) {
        return $this->model->atualizar($id, $dados);
    }

    public function excluir($id) {
        return $this->model->excluir($id);
    }
}
?>
