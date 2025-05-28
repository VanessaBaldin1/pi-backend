<?php

namespace ConectaConsulta\Database;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $db_name = "conecta_consulta";
    private $username = "root";
    private $password = "";
    public $conn; // Conexão PDO pública para ser acessada

    private static $instance = null; // Propriedade estática para a instância única

    // O construtor é privado para impedir a criação de novas instâncias com 'new'
    private function __construct() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Definir charset para utf8mb4 é mais seguro, se o BD suportar
            $this->conn->exec("SET NAMES utf8mb4");
        } catch(PDOException $e) {
            // Em um ambiente de produção, você deve logar o erro em vez de exibi-lo diretamente
            // error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
            die("Erro de conexão com o banco de dados. Tente novamente mais tarde.");
        }
    }

    /**
     * Retorna a única instância da classe Database (Singleton).
     *
     * @return Database A instância única da classe Database.
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self(); // Cria a instância se ela não existir
        }
        return self::$instance;
    }

    /**
     * Retorna o objeto de conexão PDO.
     *
     * @return PDO O objeto de conexão PDO.
     */
    public function getConnection() {
        return $this->conn;
    }

    // Métodos __clone() e __wakeup() privados para impedir a clonagem e desserialização
    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot deserialize a singleton.");
    }
} 