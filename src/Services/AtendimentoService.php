<?php
require_once __DIR__ . '/../Models/Atendimento.php';

class AtendimentoService {
    private $conn;
    private $atendimento;

    public function __construct($db) {
        $this->conn = $db;
        $this->atendimento = new Atendimento($this->conn);
    }

    public function criarAtendimento($dados) {
        $this->atendimento->nome_paciente = $dados['paciente_id'];
        $this->atendimento->nome_medico = $dados['medico_id'];
        $this->atendimento->data_atendimento = $dados['data_atendimento'];
        $this->atendimento->hora_atendimento = $dados['hora_atendimento'];
        $this->atendimento->tipo_atendimento = $dados['tipo_atendimento'];
        $this->atendimento->observacoes = $dados['observacoes'];

        if($this->atendimento->create()) {
            return ["status" => "success", "message" => "Atendimento agendado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível agendar o atendimento"];
    }

    public function atualizarAtendimento($dados) {
        $this->atendimento->id = $dados['id'];
        $this->atendimento->nome_paciente = $dados['paciente_id'];
        $this->atendimento->nome_medico = $dados['medico_id'];
        $this->atendimento->data_atendimento = $dados['data_atendimento'];
        $this->atendimento->hora_atendimento = $dados['hora_atendimento'];
        $this->atendimento->tipo_atendimento = $dados['tipo_atendimento'];
        $this->atendimento->observacoes = $dados['observacoes'];

        if($this->atendimento->update()) {
            return ["status" => "success", "message" => "Atendimento atualizado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível atualizar o atendimento"];
    }

    public function excluirAtendimento($id) {
        $this->atendimento->id = $id;
        
        if($this->atendimento->delete()) {
            return ["status" => "success", "message" => "Atendimento excluído com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível excluir o atendimento"];
    }

    public function listarAtendimentos() {
        $stmt = $this->atendimento->read();
        $atendimentos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $atendimentos[] = $row;
        }
        
        return $atendimentos;
    }

    public function buscarAtendimento($id) {
        $this->atendimento->id = $id;
        if($this->atendimento->readOne()) {
            return [
                "id" => $id,
                "nome_paciente" => $this->atendimento->nome_paciente,
                "nome_medico" => $this->atendimento->nome_medico,
                "data_atendimento" => $this->atendimento->data_atendimento,
                "hora_atendimento" => $this->atendimento->hora_atendimento,
                "tipo_atendimento" => $this->atendimento->tipo_atendimento,
                "observacoes" => $this->atendimento->observacoes
            ];
        }
        return null;
    }
} 