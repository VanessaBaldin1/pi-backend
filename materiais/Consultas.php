<?php 
namespace ConectaConsulta\Models;

use PDO;

class Consultas {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function listar() {
        $stmt = $this->db->query("
            SELECT c.*, p.nome as paciente_nome, m.nome as medico_nome 
            FROM consultas c
            LEFT JOIN pacientes p ON c.paciente_id = p.id
            LEFT JOIN medicos m ON c.medico_id = m.id
            ORDER BY c.data_consulta DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("
            SELECT c.*, p.nome as paciente_nome, m.nome as medico_nome 
            FROM consultas c
            LEFT JOIN pacientes p ON c.paciente_id = p.id
            LEFT JOIN medicos m ON c.medico_id = m.id
            WHERE c.id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $stmt = $this->db->prepare("
            INSERT INTO consultas (paciente_id, medico_id, data_consulta, horario, status, observacoes)
            VALUES (:paciente_id, :medico_id, :data_consulta, :horario, :status, :observacoes)
        ");
        
        return $stmt->execute([
            ':paciente_id' => $dados['paciente_id'],
            ':medico_id' => $dados['medico_id'],
            ':data_consulta' => $dados['data_consulta'],
            ':horario' => $dados['horario'],
            ':status' => $dados['status'],
            ':observacoes' => $dados['observacoes']
        ]);
    }

    public function atualizar($id, $dados) {
        $stmt = $this->db->prepare("
            UPDATE consultas 
            SET paciente_id = :paciente_id,
                medico_id = :medico_id,
                data_consulta = :data_consulta,
                horario = :horario,
                status = :status,
                observacoes = :observacoes
            WHERE id = :id
        ");
        
        $dados['id'] = $id;
        return $stmt->execute($dados);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM consultas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function buscarPorPaciente($paciente_id) {
        $stmt = $this->db->prepare("
            SELECT c.*, m.nome as medico_nome 
            FROM consultas c
            LEFT JOIN medicos m ON c.medico_id = m.id
            WHERE c.paciente_id = :paciente_id
            ORDER BY c.data_consulta DESC
        ");
        $stmt->bindParam(':paciente_id', $paciente_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorMedico($medico_id) {
        $stmt = $this->db->prepare("
            SELECT c.*, p.nome as paciente_nome 
            FROM consultas c
            LEFT JOIN pacientes p ON c.paciente_id = p.id
            WHERE c.medico_id = :medico_id
            ORDER BY c.data_consulta DESC
        ");
        $stmt->bindParam(':medico_id', $medico_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

