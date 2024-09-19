<?php

require_once '../model/db/SpreadsheetModel.php';

class SpreadsheetController {
    private $spreadsheetModel;

    public function __construct() {
        $this->spreadsheetModel = new SpreadsheetModel();
    }

    public function createSpreadsheet(Spreadsheet $spreadsheet) : Spreadsheet {
        $this->spreadsheetModel->createSpreadsheet($spreadsheet);
        return $spreadsheet;
    }

    public function getSpreadsheetById($id) : Spreadsheet {
        $spreadsheet = $this->spreadsheetModel->getSpreadsheetById($id);
        $spreadsheetObj = new Spreadsheet();
        $spreadsheetObj->setId($spreadsheet['id']);
        $spreadsheetObj->setCodigo($spreadsheet['codigo']);
        $spreadsheetObj->setNome($spreadsheet['nome']);
        $spreadsheetObj->setDescricao($spreadsheet['descricao']);
        $spreadsheetObj->setCategoria($spreadsheet['categoria']);
        $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
        $spreadsheetObj->setIdUsuario($spreadsheet['id_usuario']);
        $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
        $spreadsheetObj->setConteudo($spreadsheet['conteudo']);
        return $spreadsheetObj;
    }

    public function updateSpreadsheet($spreadsheet) {
        return $this->spreadsheetModel->updateSpreadsheet($spreadsheet);
    }

    public function deleteSpreadsheet($id) {
        return $this->spreadsheetModel->deleteSpreadsheet($id);
    }

    public function getAllSpreadsheets() {
        $spreadsheets = $this->spreadsheetModel->getAllSpreadsheets();
        $spreadsheetsList = [];
        foreach ($spreadsheets as $spreadsheet) {
            $spreadsheetObj = new Spreadsheet();
            $spreadsheetObj->setId($spreadsheet['id']);
            $spreadsheetObj->setCodigo($spreadsheet['codigo']);
            $spreadsheetObj->setNome($spreadsheet['nome']);
            $spreadsheetObj->setDescricao($spreadsheet['descricao']);
            $spreadsheetObj->setCategoria($spreadsheet['categoria']);
            $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
            $spreadsheetObj->setIdUsuario($spreadsheet['id_usuario']);
            $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
            $spreadsheetObj->setConteudo($spreadsheet['conteudo']);
            $spreadsheetsList[] = $spreadsheetObj;
        }
        return $spreadsheetsList;
    }

    public function getSpreadsheetsByUserId($id) {
        $spreadsheets = $this->spreadsheetModel->getSpreadsheetsByUserId($id);
        $spreadsheetsList = [];
        foreach ($spreadsheets as $spreadsheet) {
            $spreadsheetObj = new Spreadsheet();
            $spreadsheetObj->setId($spreadsheet['id']);
            $spreadsheetObj->setCodigo($spreadsheet['codigo']);
            $spreadsheetObj->setNome($spreadsheet['nome']);
            $spreadsheetObj->setDescricao($spreadsheet['descricao']);
            $spreadsheetObj->setCategoria($spreadsheet['categoria']);
            $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
            $spreadsheetObj->setIdUsuario($spreadsheet['id_usuario']);
            $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
            $spreadsheetObj->setConteudo($spreadsheet['conteudo']);
            $spreadsheetsList[] = $spreadsheetObj;
        }
        return $spreadsheetsList;
    }

    public function getSpreadsheetsByCategory($categoria) {
        $spreadsheets = $this->spreadsheetModel->getSpreadsheetsByCategory($categoria);
        $spreadsheetsList = [];
        foreach ($spreadsheets as $spreadsheet) {
            $spreadsheetObj = new Spreadsheet();
            $spreadsheetObj->setId($spreadsheet['id']);
            $spreadsheetObj->setCodigo($spreadsheet['codigo']);
            $spreadsheetObj->setNome($spreadsheet['nome']);
            $spreadsheetObj->setDescricao($spreadsheet['descricao']);
            $spreadsheetObj->setCategoria($spreadsheet['categoria']);
            $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
            $spreadsheetObj->setIdUsuario($spreadsheet['id_usuario']);
            $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
            $spreadsheetObj->setConteudo($spreadsheet['conteudo']);
            $spreadsheetsList[] = $spreadsheetObj;
        }
        return $spreadsheetsList;
    }

    //Retornar número total de registros geral, por tipo ou visibilidade
    public function getTotalSpreadsheets() {
        return $this->spreadsheetModel->getTotalSpreadsheets();
    }

    public function getTotalSpreadsheetsByCategory($categoria) {
        return $this->spreadsheetModel->getTotalSpreadsheets($categoria);
    }

    public function getTotalSpreadsheetsByVisibility($visibilidade) {
        return $this->spreadsheetModel->getTotalSpreadsheets(null, $visibilidade);
    }

    public function getTotalSpreadsheetsByCategoryAndVisibility($categoria, $visibilidade) {
        return $this->spreadsheetModel->getTotalSpreadsheets($categoria, $visibilidade);
    }

}