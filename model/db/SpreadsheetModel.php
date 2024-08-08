<?php

require_once 'Database.php';
require_once 'Spreadsheet.php';

class SpreadsheetModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createSpreadsheet(Spreadsheet $spreadsheet) {
        $sql = "INSERT INTO spreadsheets (codigo, nome, descricao, categoria, visibilidade, id_usuario, data_cadastro, conteudo) VALUES (:codigo, :nome, :descricao, :categoria, :visibilidade, :id_usuario, :data_cadastro, :conteudo)";
        $params = [
            ':codigo' => $spreadsheet->getCodigo(),
            ':nome' => $spreadsheet->getNome(),
            ':descricao' => $spreadsheet->getDescricao(),
            ':categoria' => $spreadsheet->getCategoria(),
            ':visibilidade' => $spreadsheet->getVisibilidade(),
            ':id_usuario' => $spreadsheet->getIdUsuario(),
            ':data_cadastro' => $spreadsheet->getDataCadastro(),
            ':conteudo' => $spreadsheet->getConteudo()
        ];
        return $this->db->executeQuery($sql, $params);
    }

    public function getSpreadsheetById($id) {
        $sql = "SELECT * FROM spreadsheets WHERE id = :id";
        $params = [':id' => $id];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSpreadsheet(Spreadsheet $spreadsheet) {
        $sql = "UPDATE spreadsheets SET codigo = :codigo, nome = :nome, descricao = :descricao, categoria = :categoria, visibilidade = :visibilidade, id_usuario = :id_usuario, data_cadastro = :data_cadastro, conteudo = :conteudo WHERE id = :id";
        $params = [
            ':id' => $spreadsheet->getId(),
            ':codigo' => $spreadsheet->getCodigo(),
            ':nome' => $spreadsheet->getNome(),
            ':descricao' => $spreadsheet->getDescricao(),
            ':categoria' => $spreadsheet->getCategoria(),
            ':visibilidade' => $spreadsheet->getVisibilidade(),
            ':id_usuario' => $spreadsheet->getIdUsuario(),
            ':data_cadastro' => $spreadsheet->getDataCadastro(),
            ':conteudo' => $spreadsheet->getConteudo()
        ];
        return $this->db->executeQuery($sql, $params);

    }

    public function deleteSpreadsheet($id) {
        $sql = "DELETE FROM spreadsheets WHERE id = :id";
        $params = [':id' => $id];
        return $this->db->executeQuery($sql, $params);
    }

    public function getAllSpreadsheets() {
        $sql = "SELECT * FROM spreadsheets";
        $stmt = $this->db->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSpreadsheetsByUserId($id_usuario) {
        $sql = "SELECT * FROM spreadsheets WHERE id_usuario = :id_usuario";
        $params = [':id_usuario' => $id_usuario];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSpreadsheetsByCategory($categoria) {
        $sql = "SELECT * FROM spreadsheets WHERE categoria = :categoria";
        $params = [':categoria' => $categoria];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}