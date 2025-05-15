<?php
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../config/Database.php';

class PacienteService {
    private $db;
    private $paciente;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->paciente = new Paciente($this->db);
    }

    public function criarPaciente($dados) {
        $this->paciente->nome = $dados['nome'];
        $this->paciente->cpf = $dados['cpf'];
        $this->paciente->data_nascimento = $dados['data_nascimento'];
        $this->paciente->telefone = $dados['telefone'];
        $this->paciente->email = $dados['email'];
        $this->paciente->endereco = $dados['endereco'];

        if($this->paciente->create()) {
            return ["status" => "success", "message" => "Paciente cadastrado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível cadastrar o paciente"];
    }

    public function atualizarPaciente($dados) {
        $this->paciente->id = $dados['id'];
        $this->paciente->nome = $dados['nome'];
        $this->paciente->cpf = $dados['cpf'];
        $this->paciente->data_nascimento = $dados['data_nascimento'];
        $this->paciente->telefone = $dados['telefone'];
        $this->paciente->email = $dados['email'];
        $this->paciente->endereco = $dados['endereco'];

        if($this->paciente->update()) {
            return ["status" => "success", "message" => "Paciente atualizado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível atualizar o paciente"];
    }

    public function excluirPaciente($id) {
        $this->paciente->id = $id;
        
        if($this->paciente->delete()) {
            return ["status" => "success", "message" => "Paciente excluído com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível excluir o paciente"];
    }

    public function listarPacientes() {
        $stmt = $this->paciente->read();
        $pacientes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pacientes[] = $row;
        }
        
        return $pacientes;
    }

    public function buscarPaciente($id) {
        $this->paciente->id = $id;
        if($this->paciente->readOne()) {
            return [
                "id" => $id,
                "nome" => $this->paciente->nome,
                "cpf" => $this->paciente->cpf,
                "data_nascimento" => $this->paciente->data_nascimento,
                "telefone" => $this->paciente->telefone,
                "email" => $this->paciente->email,
                "endereco" => $this->paciente->endereco
            ];
        }
        return null;
    }
} 