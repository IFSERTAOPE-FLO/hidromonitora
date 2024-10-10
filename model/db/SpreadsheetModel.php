<?php

require_once 'Database.php';
require_once 'model/Spreadsheet.php';

class SpreadsheetModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createSpreadsheet(Spreadsheet $spreadsheet) {
        $sql = "INSERT INTO spreadsheets (codigo, nome, descricao, tipo, visibilidade, autor, data_cadastro, formato, tamanho, conteudo) VALUES (:codigo, :nome, :descricao, :tipo, :visibilidade, :autor, :data_cadastro, :formato, :tamanho, :conteudo)";
        $params = [
            ':codigo' => $spreadsheet->getCodigo(),
            ':nome' => $spreadsheet->getNome(),
            ':descricao' => $spreadsheet->getDescricao(),
            ':tipo' => $spreadsheet->getTipo(),
            ':visibilidade' => $spreadsheet->getVisibilidade(),
            ':autor' => $spreadsheet->getAutor(),
            ':data_cadastro' => NOW(),
            ':formato' => $spreadsheet->getFormato(),
            ':tamanho' => $spreadsheet->getTamanho(),
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
        $sql = "UPDATE spreadsheets SET codigo = :codigo, nome = :nome, descricao = :descricao, tipo = :tipo, visibilidade = :visibilidade, conteudo = :conteudo WHERE id = :id";
        $params = [
            ':id' => $spreadsheet->getId(),
            ':codigo' => $spreadsheet->getCodigo(),
            ':nome' => $spreadsheet->getNome(),
            ':descricao' => $spreadsheet->getDescricao(),
            ':tipo' => $spreadsheet->getTipo(),
            ':visibilidade' => $spreadsheet->getVisibilidade(),
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

    public function getSpreadsheetsByUserId($autor) {
        $sql = "SELECT * FROM spreadsheets WHERE autor = :autor";
        $params = [':autor' => $autor];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSpreadsheetsByCategory($tipo) {
        $sql = "SELECT * FROM spreadsheets WHERE tipo = :tipo";
        $params = [':tipo' => $tipo];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Retornar número total de registros geral, por tipo ou visibilidade
    public function getTotalSpreadsheets($tipo = null, $visibilidade = null) {
        if ($tipo == null && $visibilidade == null) {
            $sql = "SELECT COUNT(*) FROM spreadsheets";
            $stmt = $this->db->executeQuery($sql);
            return $stmt->fetchColumn();
        } else if ($tipo != null && $visibilidade == null) {
            $sql = "SELECT COUNT(*) FROM spreadsheets WHERE tipo = :tipo";
            $params = [':tipo' => $tipo];
            $stmt = $this->db->executeQuery($sql, $params);
            return $stmt->fetchColumn();
        } else if ($tipo == null && $visibilidade != null) {
            $sql = "SELECT COUNT(*) FROM spreadsheets WHERE visibilidade = :visibilidade";
            $params = [':visibilidade' => $visibilidade];
            $stmt = $this->db->executeQuery($sql, $params);
            return $stmt->fetchColumn();
        } else {
            $sql = "SELECT COUNT(*) FROM spreadsheets WHERE tipo = :tipo AND visibilidade = :visibilidade";
            $params = [':tipo' => $tipo, ':visibilidade' => $visibilidade];
            $stmt = $this->db->executeQuery($sql, $params);
            return $stmt->fetchColumn();
        }
    }

    //verificar a existência do código e resultado é colocado em um array
    public function checkCode($codigo) {
        $sql = "SELECT * FROM spreadsheets WHERE codigo = :codigo";
        $params = [':codigo' => $codigo];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   // retornar os registros de acordo com o filtro selecionado em $filtro
    public function getSpreadsheetsByFilter($tipo, $visibilidade) {
        $sql = "SELECT * FROM spreadsheets WHERE tipo = :tipo AND visibilidade = :visibilidade";
        $params = [':tipo' => $tipo, ':visibilidade' => $visibilidade];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function definirFiltros($filtro) {
        $tipo = null;
        $visibilidade = null;

        switch ($filtro) {
            case 'todos':
                break; // Não faz nada, já está como null
            case 'biologico':
                $tipo = 'biologico';
                break;
            case 'ambiental':
                $tipo = 'ambiental';
                break;
            case 'etnobiologico':
                $tipo = 'etnobiologico'; 
                break;
            case '1':
                $visibilidade = 1; // Somente visíveis
                break;
            case '0':
                $visibilidade = 0; // Somente desabilitados
                break;
        }

        return ['tipo' => $tipo, 'visibilidade' => $visibilidade];

    }

     // Method to get the filter SQL based on user input
     public function getFilterSQL($filtro) {
        switch ($filtro) {
            case 'todos':
                return '';
            case 'biologico':
                return "WHERE tipo = 'biologico'";
            case 'ambiental':
                return "WHERE tipo = 'ambiental'";
            case 'etnobiologico':
                return "WHERE tipo = 'etnobiologico'";
            case '1':
                return "WHERE visibilidade = 1";
            case '0':
                return "WHERE visibilidade = 0";
            default:
                return '';
        }
    }

    
   
}   