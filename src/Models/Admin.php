<?php

namespace ConectaConsulta\Models;

use PDO;
use ConectaConsulta\Database\Database; // Assumindo que sua classe Database está em src/Database

class Admin {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Cadastra um novo administrador no banco de dados.
     *
     * @param string $email O email do administrador (deve ser único).
     * @param string $senhaHash O hash da senha do administrador (gerado por password_hash).
     * @return bool True se o cadastro for bem-sucedido, false caso contrário (ex: email duplicado).
     */
    public function criar($email, $senhaHash) {
        $sql = "INSERT INTO administradores (email, senha) VALUES (:email, :senha)";
        $stmt = $this->db->prepare($sql);
        
        try {
            return $stmt->execute([':email' => $email, ':senha' => $senhaHash]);
        } catch (\PDOException $e) {
            // Verifica se é um erro de violação de restrição única (email duplicado)
            if ($e->getCode() === '23000') {
                return false; // Indica que o email já existe
            }
            // Relança outras exceções PDO para serem tratadas em outra camada
            throw $e;
        }
    }

    /**
     * Busca um administrador por email.
     *
     * @param string $email O email do administrador.
     * @return array|false Os dados do administrador (email, senha) se encontrado, false caso contrário.
     */
    public function buscarPorEmail($email) {
        $sql = "SELECT id, email, senha FROM administradores WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Você pode adicionar outros métodos conforme necessário (buscarPorId, etc.)
}

?> 