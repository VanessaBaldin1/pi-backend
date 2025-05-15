<?php

class Atendimento {
    private $conn;
    private $table_name = "atendimentos";

    public $id;
    public $paciente_id;
    public $medico_id;
    public $data_hora;
    public $diagnostico;
    public $prescricao;
    public $observacoes;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                (paciente_id, medico_id, data_hora, diagnostico, prescricao, observacoes)
                VALUES
                (:paciente_id, :medico_id, :data_hora, :diagnostico, :prescricao, :observacoes)";

        $stmt = $this->conn->prepare($query);

        $this->paciente_id = htmlspecialchars(strip_tags($this->paciente_id));
        $this->medico_id = htmlspecialchars(strip_tags($this->medico_id));
        $this->data_hora = htmlspecialchars(strip_tags($this->data_hora));
        $this->diagnostico = htmlspecialchars(strip_tags($this->diagnostico));
        $this->prescricao = htmlspecialchars(strip_tags($this->prescricao));
        $this->observacoes = htmlspecialchars(strip_tags($this->observacoes));

        $stmt->bindParam(":paciente_id", $this->paciente_id);
        $stmt->bindParam(":medico_id", $this->medico_id);
        $stmt->bindParam(":data_hora", $this->data_hora);
        $stmt->bindParam(":diagnostico", $this->diagnostico);
        $stmt->bindParam(":prescricao", $this->prescricao);
        $stmt->bindParam(":observacoes", $this->observacoes);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT a.*, p.nome as paciente_nome, m.nome as medico_nome 
                FROM " . $this->table_name . " a
                LEFT JOIN pacientes p ON a.paciente_id = p.id
                LEFT JOIN medicos m ON a.medico_id = m.id
                ORDER BY a.data_hora DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
} 