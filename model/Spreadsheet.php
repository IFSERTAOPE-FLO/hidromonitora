<?php

class Spreadsheet{
    private $id;
    private $codigo;
    private $nome;
    private $descricao;
    private $tipo;
    private $visibilidade;
    private $autor;
    private $data_cadastro;
    private $formato;
    private $tamanho;
    private $conteudo;

    public function __construct(){
        $args = func_get_args();
        $num = func_num_args();
        if($num == 10){
            $this->__construct8($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8], $args[9]);
        }

        if($num == 1){
            $this->__construct1($args[0]);
        }

    }

    public function __construct1($id){
        $this->id = $id;
    }

    public function __construct8($codigo, $nome, $descricao, $tipo, $visibilidade, $autor, $data_cadastro, $formato, $tamanho, $conteudo){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->tipo = $tipo;
        $this->visibilidade = $visibilidade;
        $this->autor = $autor;
        $this->data_cadastro = $data_cadastro;
        $this->formato = $formato;
        $this->tamanho = $tamanho;
        $this->conteudo = $conteudo;
    }

    public function getId(){
        return $this->id;
    }

        public function getCodigo(){
        return $this->codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getVisibilidade(){
        return $this->visibilidade;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function getDataCadastro(){
        return $this->data_cadastro;
    }

    public function getFormato(){
        return $this->formato;
    }

    public function getTamanho(){
        return $this->tamanho;
    }
    public function getConteudo(){
        return $this->conteudo;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function setVisibilidade($visibilidade){
        $this->visibilidade = $visibilidade;
    }

    public function setAutor($autor){
        $this->autor = $autor;
    }

    public function setDataCadastro($data_cadastro){
        $this->data_cadastro = $data_cadastro;
    }

    public function setFormato($formato){
        $this->formato = $formato;
    }

    public function setTamanho($tamanho){
        $this->tamanho = $tamanho;
    }
    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }
}