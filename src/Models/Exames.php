<?php

namespace ConectaConsulta\Models;

use PDO;

class Exames {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function listar() {
        $stmt = $this->db->query("
            SELECT e.*, p.nome as paciente_nome, m.nome as medico_nome 
            FROM exames e
            LEFT JOIN pacientes p ON e.paciente_id = p.id
            LEFT JOIN medicos m ON e.medico_id = m.id
            ORDER BY e.data_exame DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("
            SELECT e.*, p.nome as paciente_nome, m.nome as medico_nome 
            FROM exames e
            LEFT JOIN pacientes p ON e.paciente_id = p.id
            LEFT JOIN medicos m ON e.medico_id = m.id
            WHERE e.id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorPaciente($paciente_id) {
        $stmt = $this->db->prepare("
            SELECT e.*, m.nome as medico_nome 
            FROM exames e
            LEFT JOIN medicos m ON e.medico_id = m.id
            WHERE e.paciente_id = :paciente_id
            ORDER BY e.data_exame DESC
        ");
        $stmt->bindParam(':paciente_id', $paciente_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $stmt = $this->db->prepare("
            INSERT INTO exames (paciente_id, medico_id, tipo_exame, data_exame, resultado, observacoes)
            VALUES (:paciente_id, :medico_id, :tipo_exame, :data_exame, :resultado, :observacoes)
        ");
        
        return $stmt->execute([
            ':paciente_id' => $dados['paciente_id'],
            ':medico_id' => $dados['medico_id'],
            ':tipo_exame' => $dados['tipo_exame'],
            ':data_exame' => $dados['data_exame'],
            ':resultado' => $dados['resultado'],
            ':observacoes' => $dados['observacoes']
        ]);
    }

    public function atualizar($id, $dados) {
        $stmt = $this->db->prepare("
            UPDATE exames 
            SET paciente_id = :paciente_id,
                medico_id = :medico_id,
                tipo_exame = :tipo_exame,
                data_exame = :data_exame,
                resultado = :resultado,
                observacoes = :observacoes
            WHERE id = :id
        ");
        
        $dados['id'] = $id;
        return $stmt->execute($dados);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM exames WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
