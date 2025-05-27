<?php

namespace ConectaConsulta\Services;

use ConectaConsulta\Models\Pacientes;
use ConectaConsulta\Utils\Validacao;
use PDO;

class PacienteServico {
    private $model;

    public function __construct() {
        $this->model = new Pacientes();
    }

    public function listar() {
        return $this->model->listar();
    }

    public function buscarPorId($id) {
        return $this->model->buscarPorId($id);
    }

    public function criar($dados) {
        // Valida o CPF antes de criar
        if (!Validacao::validarCPF($dados['cpf'])) {
            throw new \Exception('CPF inválido');
        }
        return $this->model->criar($dados);
    }

    public function atualizar($id, $dados) {
        // Valida o CPF antes de atualizar
        if (!Validacao::validarCPF($dados['cpf'])) {
            throw new \Exception('CPF inválido');
        }
        return $this->model->atualizar($id, $dados);
    }

    public function excluir($id) {
        return $this->model->excluir($id);
    }
}
?>
