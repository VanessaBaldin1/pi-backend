<?php

namespace ConectaConsulta\Models;

use PDO;

class Medicos {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function listar() {
        $stmt = $this->db->query("SELECT * FROM medicos ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM medicos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $stmt = $this->db->prepare("
            INSERT INTO medicos (nome, crm, especialidade, email, telefone)
            VALUES (:nome, :crm, :especialidade, :email, :telefone)
        ");
        
        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':crm' => $dados['crm'],
            ':especialidade' => $dados['especialidade'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone']
        ]);
    }

    public function atualizar($id, $dados) {
        $stmt = $this->db->prepare("
            UPDATE medicos 
            SET nome = :nome, 
                crm = :crm, 
                especialidade = :especialidade, 
                email = :email, 
                telefone = :telefone
            WHERE id = :id
        ");
        
        $dados['id'] = $id;
        return $stmt->execute($dados);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM medicos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
