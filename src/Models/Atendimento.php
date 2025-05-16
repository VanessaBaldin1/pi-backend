<?php

class Atendimento {
    private $conn;
    private $table_name = "atendimentos";

    public $id;
    public $nome_paciente;
    public $nome_medico;
    public $data_atendimento;
    public $hora_atendimento;
    public $tipo_atendimento;
    public $observacoes;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                (nome_paciente, nome_medico, data_atendimento, hora_atendimento, tipo_atendimento, observacoes)
                VALUES
                (:nome_paciente, :nome_medico, :data_atendimento, :hora_atendimento, :tipo_atendimento, :observacoes)";

        $stmt = $this->conn->prepare($query);

        $this->nome_paciente = htmlspecialchars(strip_tags($this->nome_paciente));
        $this->nome_medico = htmlspecialchars(strip_tags($this->nome_medico));
        $this->data_atendimento = htmlspecialchars(strip_tags($this->data_atendimento));
        $this->hora_atendimento = htmlspecialchars(strip_tags($this->hora_atendimento));
        $this->tipo_atendimento = htmlspecialchars(strip_tags($this->tipo_atendimento));
        $this->observacoes = htmlspecialchars(strip_tags($this->observacoes));

        $stmt->bindParam(":nome_paciente", $this->nome_paciente);
        $stmt->bindParam(":nome_medico", $this->nome_medico);
        $stmt->bindParam(":data_atendimento", $this->data_atendimento);
        $stmt->bindParam(":hora_atendimento", $this->hora_atendimento);
        $stmt->bindParam(":tipo_atendimento", $this->tipo_atendimento);
        $stmt->bindParam(":observacoes", $this->observacoes);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET
                    nome_paciente = :nome_paciente,
                    nome_medico = :nome_medico,
                    data_atendimento = :data_atendimento,
                    hora_atendimento = :hora_atendimento,
                    tipo_atendimento = :tipo_atendimento,
                    observacoes = :observacoes
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nome_paciente = htmlspecialchars(strip_tags($this->nome_paciente));
        $this->nome_medico = htmlspecialchars(strip_tags($this->nome_medico));
        $this->data_atendimento = htmlspecialchars(strip_tags($this->data_atendimento));
        $this->hora_atendimento = htmlspecialchars(strip_tags($this->hora_atendimento));
        $this->tipo_atendimento = htmlspecialchars(strip_tags($this->tipo_atendimento));
        $this->observacoes = htmlspecialchars(strip_tags($this->observacoes));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nome_paciente", $this->nome_paciente);
        $stmt->bindParam(":nome_medico", $this->nome_medico);
        $stmt->bindParam(":data_atendimento", $this->data_atendimento);
        $stmt->bindParam(":hora_atendimento", $this->hora_atendimento);
        $stmt->bindParam(":tipo_atendimento", $this->tipo_atendimento);
        $stmt->bindParam(":observacoes", $this->observacoes);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_atendimento DESC, hora_atendimento DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nome_paciente = $row['nome_paciente'];
            $this->nome_medico = $row['nome_medico'];
            $this->data_atendimento = $row['data_atendimento'];
            $this->hora_atendimento = $row['hora_atendimento'];
            $this->tipo_atendimento = $row['tipo_atendimento'];
            $this->observacoes = $row['observacoes'];
            return true;
        }
        return false;
    }
} 