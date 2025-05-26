<?php

namespace ConectaConsulta\Models;

use PDO;

class Pacientes {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function listar() {
        $stmt = $this->db->query("SELECT * FROM pacientes ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM pacientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $stmt = $this->db->prepare("
            INSERT INTO pacientes (nome, cpf, email, telefone, data_nascimento)
            VALUES (:nome, :cpf, :email, :telefone, :data_nascimento)
        ");
        
        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':cpf' => $dados['cpf'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':data_nascimento' => $dados['data_nascimento']
        ]);
    }

    public function atualizar($id, $dados) {
        $stmt = $this->db->prepare("
            UPDATE pacientes 
            SET nome = :nome, 
                cpf = :cpf, 
                email = :email, 
                telefone = :telefone, 
                data_nascimento = :data_nascimento
            WHERE id = :id
        ");
        
        $dados['id'] = $id;
        return $stmt->execute($dados);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM pacientes WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
