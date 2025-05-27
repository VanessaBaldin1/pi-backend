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
        // Verifica se já existe um médico com este CRM
        $medicos = $this->model->listar();
        foreach ($medicos as $medico) {
            if ($medico['crm'] === $dados['crm']) {
                throw new \Exception('Já existe um médico cadastrado com este CRM');
            }
        }
        return $this->model->criar($dados);
    }

    public function atualizar($id, $dados) {
        // Verifica se já existe outro médico com este CRM
        $medicos = $this->model->listar();
        foreach ($medicos as $medico) {
            if ($medico['crm'] === $dados['crm'] && $medico['id'] != $id) {
                throw new \Exception('Já existe um médico cadastrado com este CRM');
            }
        }
        return $this->model->atualizar($id, $dados);
    }

    public function excluir($id) {
        return $this->model->excluir($id);
    }
}
?>
