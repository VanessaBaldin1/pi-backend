<?php
require_once __DIR__ . '/../models/Atendimento.php';
require_once __DIR__ . '/../config/Database.php';

class AtendimentoService {
    private $db;
    private $atendimento;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->atendimento = new Atendimento($this->db);
    }

    public function criarAtendimento($dados) {
        $this->atendimento->paciente_id = $dados['paciente_id'];
        $this->atendimento->medico_id = $dados['medico_id'];
        $this->atendimento->data_hora = $dados['data_hora'];
        $this->atendimento->diagnostico = $dados['diagnostico'];
        $this->atendimento->prescricao = $dados['prescricao'];
        $this->atendimento->observacoes = $dados['observacoes'];

        if($this->atendimento->create()) {
            return ["status" => "success", "message" => "Atendimento criado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível criar o atendimento"];
    }

    public function listarAtendimentos() {
        $stmt = $this->atendimento->read();
        $atendimentos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $atendimentos[] = $row;
        }
        
        return $atendimentos;
    }
} 