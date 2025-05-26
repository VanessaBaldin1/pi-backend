<?php

namespace ConectaConsulta\Services;

use ConectaConsulta\Models\Consulta;
use ConectaConsulta\Models\Database;
use PDO;

class ConsultaServico {
    private $db;
    private $consulta;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->consulta = new Consulta($this->db);
    }

    public function listar() {
        $sql = "SELECT c.*, p.nome as paciente_nome, m.nome as medico_nome 
                FROM consultas c 
                JOIN pacientes p ON c.paciente_id = p.id 
                JOIN medicos m ON c.medico_id = m.id 
                ORDER BY c.data_consulta DESC, c.hora_consulta DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        return $this->consulta->buscarPorId($id);
    }

    public function criar($dados) {
        return $this->consulta->criar($dados);
    }

    public function atualizar($id, $dados) {
        return $this->consulta->atualizar($id, $dados);
    }

    public function excluir($id) {
        return $this->consulta->excluir($id);
    }
} 