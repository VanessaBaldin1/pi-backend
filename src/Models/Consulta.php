<?php

namespace ConectaConsulta\Models;

use PDO;

class Consulta {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM consultas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $sql = "INSERT INTO consultas (paciente_id, medico_id, data_consulta, hora_consulta, status, observacoes) 
                VALUES (:paciente_id, :medico_id, :data_consulta, :hora_consulta, :status, :observacoes)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'paciente_id' => $dados['paciente_id'],
            'medico_id' => $dados['medico_id'],
            'data_consulta' => $dados['data_consulta'],
            'hora_consulta' => $dados['hora_consulta'],
            'status' => $dados['status'],
            'observacoes' => $dados['observacoes'] ?? null
        ]);
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE consultas 
                SET paciente_id = :paciente_id,
                    medico_id = :medico_id,
                    data_consulta = :data_consulta,
                    hora_consulta = :hora_consulta,
                    status = :status,
                    observacoes = :observacoes
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'paciente_id' => $dados['paciente_id'],
            'medico_id' => $dados['medico_id'],
            'data_consulta' => $dados['data_consulta'],
            'hora_consulta' => $dados['hora_consulta'],
            'status' => $dados['status'],
            'observacoes' => $dados['observacoes'] ?? null
        ]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM consultas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
} 