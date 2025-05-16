<?php
require_once __DIR__ . '/../models/Medico.php';
require_once __DIR__ . '/../config/Database.php';

class MedicoService {
    private $db;
    private $medico;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->medico = new Medico($this->db);
    }

    public function criarMedico($dados) {
        $this->medico->nome = $dados['nome'];
        $this->medico->crm = $dados['crm'];
        $this->medico->especialidade = $dados['especialidade'];
        $this->medico->telefone = $dados['telefone'];
        $this->medico->email = $dados['email'];

        if($this->medico->create()) {
            return ["status" => "success", "message" => "Médico cadastrado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível cadastrar o médico"];
    }

    public function atualizarMedico($dados) {
        $this->medico->id = $dados['id'];
        $this->medico->nome = $dados['nome'];
        $this->medico->crm = $dados['crm'];
        $this->medico->especialidade = $dados['especialidade'];
        $this->medico->telefone = $dados['telefone'];
        $this->medico->email = $dados['email'];

        if($this->medico->update()) {
            return ["status" => "success", "message" => "Médico atualizado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível atualizar o médico"];
    }

    public function excluirMedico($id) {
        $this->medico->id = $id;
        
        if($this->medico->delete()) {
            return ["status" => "success", "message" => "Médico excluído com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível excluir o médico"];
    }

    public function listarMedicos() {
        $stmt = $this->medico->read();
        $medicos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $medicos[] = $row;
        }
        
        return $medicos;
    }

    public function buscarMedico($id) {
        $this->medico->id = $id;
        if($this->medico->readOne()) {
            return [
                "id" => $id,
                "nome" => $this->medico->nome,
                "crm" => $this->medico->crm,
                "especialidade" => $this->medico->especialidade,
                "telefone" => $this->medico->telefone,
                "email" => $this->medico->email
            ];
        }
        return null;
    }
} 