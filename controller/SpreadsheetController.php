<?php

require_once 'model/db/SpreadsheetModel.php';

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
        $spreadsheetObj->setTipo($spreadsheet['tipo']);
        $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
        $spreadsheetObj->setAutor($spreadsheet['autor']);
        $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
        $spreadsheetObj->setFormato($spreadsheet['formato']);
        $spreadsheetObj->setTamanho($spreadsheet['tamanho']);
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
            $spreadsheetObj->setTipo($spreadsheet['tipo']);
            $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
            $spreadsheetObj->setAutor($spreadsheet['autor']);
            $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
            $spreadsheetObj->setFormato($spreadsheet['formato']);
            $spreadsheetObj->setTamanho($spreadsheet['tamanho']);
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
            $spreadsheetObj->setTipo($spreadsheet['tipo']);
            $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
            $spreadsheetObj->setAutor($spreadsheet['autor']);
            $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
            $spreadsheetObj->setFormato($spreadsheet['formato']);
            $spreadsheetObj->setTamanho($spreadsheet['tamanho']);
            $spreadsheetObj->setConteudo($spreadsheet['conteudo']);
            $spreadsheetsList[] = $spreadsheetObj;
        }
        return $spreadsheetsList;
    }

    public function getSpreadsheetsByCategory($tipo) {
        $spreadsheets = $this->spreadsheetModel->getSpreadsheetsByCategory($tipo);
        $spreadsheetsList = [];
        foreach ($spreadsheets as $spreadsheet) {
            $spreadsheetObj = new Spreadsheet();
            $spreadsheetObj->setId($spreadsheet['id']);
            $spreadsheetObj->setCodigo($spreadsheet['codigo']);
            $spreadsheetObj->setNome($spreadsheet['nome']);
            $spreadsheetObj->setDescricao($spreadsheet['descricao']);
            $spreadsheetObj->setTipo($spreadsheet['tipo']);
            $spreadsheetObj->setVisibilidade($spreadsheet['visibilidade']);
            $spreadsheetObj->setAutor($spreadsheet['autor']);
            $spreadsheetObj->setDataCadastro($spreadsheet['data_cadastro']);
            $spreadsheetObj->setFormato($spreadsheet['formato']);
            $spreadsheetObj->setTamanho($spreadsheet['tamanho']);
            $spreadsheetObj->setConteudo($spreadsheet['conteudo']);
            $spreadsheetsList[] = $spreadsheetObj;
        }
        return $spreadsheetsList;
    }

    //Retornar número total de registros geral, por tipo ou visibilidade
    public function getTotalSpreadsheets() {
        return $this->spreadsheetModel->getTotalSpreadsheets();
    }

    public function getTotalSpreadsheetsByCategory($tipo) {
        return $this->spreadsheetModel->getTotalSpreadsheets($tipo);
    }

    public function getTotalSpreadsheetsByVisibility($visibilidade) {
        return $this->spreadsheetModel->getTotalSpreadsheets(null, $visibilidade);
    }

    public function getTotalSpreadsheetsByCategoryAndVisibility($tipo, $visibilidade) {
        return $this->spreadsheetModel->getTotalSpreadsheets($tipo, $visibilidade);
    }

    public function getSpreadsheetsByDate(){
        return $this->spreadsheetModel->getSpreadsheetsByDate();
    }

    public function checkCode($codigo){
        return $this->spreadsheetModel->checkCode($codigo);
    }

    public function getSpreadsheets(){
        return $this->spreadsheetModel->getSpreadsheetsByFilter();
    }

    public function getSpreadsheetsByType($tipo){
        if ($tipo == 'todos') {
            return $this->spreadsheetModel->getSpreadsheetsByFilter();
        }
        return $this->spreadsheetModel->getSpreadsheetsByFilter($tipo);
    }
    
    public function getSpreadsheetsByVisibility($visibilidade){
        return $this->spreadsheetModel->getSpreadsheetsByFilter(null, $visibilidade);
    }

    public function getSpreadsheetsByTypeAndVisibility($tipo, $visibilidade){
        return $this->spreadsheetModel->getSpreadsheetsByFilter($tipo, $visibilidade);
    }




}
