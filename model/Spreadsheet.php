<?php

class Spreadsheet{
    private $id;
    private $codigo;
    private $nome;
    private $descricao;
    private $categoria;
    private $visibilidade;
    private $id_usuario;
    private $data_cadastro;
    private $conteudo;


    public function __construct(){
        $args = func_get_args();
        $num = func_num_args();
        if($num == 8){
            $this->__construct8($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7]);
        }

        if($num == 1){
            $this->__construct1($args[0]);
        }

    }

    public function __construct1($id){
        $this->id = $id;
    }

    public function __construct8($codigo, $nome, $descricao, $categoria, $visibilidade, $id_usuario, $data_cadastro, $conteudo){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->visibilidade = $visibilidade;
        $this->id_usuario = $id_usuario;
        $this->data_cadastro = $data_cadastro;
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

    public function getCategoria(){
        return $this->categoria;
    }

    public function getVisibilidade(){
        return $this->visibilidade;
    }

    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function getDataCadastro(){
        return $this->data_cadastro;
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

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function setVisibilidade($visibilidade){
        $this->visibilidade = $visibilidade;
    }

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function setDataCadastro($data_cadastro){
        $this->data_cadastro = $data_cadastro;
    }

    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }
}