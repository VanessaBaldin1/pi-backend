<?php
require_once __DIR__ . '/../models/Exame.php';
require_once __DIR__ . '/../config/Database.php';

class ExameService {
    private $db;
    private $exame;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->exame = new Exame($this->db);
    }

    public function criarExame($dados) {
        $this->exame->nome = $dados['nome'];
        $this->exame->descricao = $dados['descricao'];
        $this->exame->preco = $dados['preco'];

        if($this->exame->create()) {
            return ["status" => "success", "message" => "Exame cadastrado com sucesso"];
        }
        return ["status" => "error", "message" => "Não foi possível cadastrar o exame"];
    }

    public function listarExames() {
        $stmt = $this->exame->read();
        $exames = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $exames[] = $row;
        }
        
        return $exames;
    }

    public function buscarExame($id) {
        $this->exame->id = $id;
        if($this->exame->readOne()) {
            return [
                "id" => $id,
                "nome" => $this->exame->nome,
                "descricao" => $this->exame->descricao,
                "preco" => $this->exame->preco
            ];
        }
        return null;
    }
} 