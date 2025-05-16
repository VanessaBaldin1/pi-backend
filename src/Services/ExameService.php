<?php
require_once __DIR__ . '/../models/Exame.php';
require_once __DIR__ . '/../config/Database.php';

class ExameService {
    private $db;
    private $exame;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->exame = new Exame($this->db);
    }

    public function criarExame($dados) {
        try {
            $resultado = $this->exame->criar($dados);
            return [
                'status' => 'success',
                'message' => 'Exame agendado com sucesso!'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao agendar exame: ' . $e->getMessage()
            ];
        }
    }

    public function atualizarExame($dados) {
        try {
            $resultado = $this->exame->atualizar($dados);
            return [
                'status' => 'success',
                'message' => 'Exame atualizado com sucesso!'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao atualizar exame: ' . $e->getMessage()
            ];
        }
    }

    public function excluirExame($id) {
        try {
            $resultado = $this->exame->excluir($id);
            return [
                'status' => 'success',
                'message' => 'Exame excluído com sucesso!'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Erro ao excluir exame: ' . $e->getMessage()
            ];
        }
    }

    public function listarExames() {
        try {
            return $this->exame->listar();
        } catch (Exception $e) {
            return [];
        }
    }

    public function buscarExame($id) {
        try {
            return $this->exame->buscar($id);
        } catch (Exception $e) {
            return null;
        }
    }
} 