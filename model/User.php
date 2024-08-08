<?php

class User{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $senha;
    private $telefone;
    private $endereco;
    private $instituicao;
    private $funcao;
    private $status;
    private $data_cadastro;
    private $data_atualizacao;

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

    public function __construct8($nome, $cpf, $email, $senha, $telefone, $endereco, $instituicao, $funcao){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->instituicao = $instituicao;
        $this->funcao = $funcao;
        $this->data_cadastro = date('Y-m-d H:i:s');
        $this->data_atualizacao = date('Y-m-d H:i:s');
        // 1 = ativo, 0 = inativo
        $this->status = 0;
    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function getInstituicao(){
        return $this->instituicao;
    }

    public function getFuncao(){
        return $this->funcao;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getDataCadastro(){
        return $this->data_cadastro;
    }

    public function getDataAtualizacao(){
        return $this->data_atualizacao;
    }   

    public function setId($id){
        $this->id = $id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function setInstituicao($instituicao){
        $this->instituicao = $instituicao;
    }

    public function setFuncao($funcao){
        $this->funcao = $funcao;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setDataCadastro($data_cadastro){
        $this->data_cadastro = $data_cadastro;
    }

    public function setDataAtualizacao($data_atualizacao){
        $this->data_atualizacao = $data_atualizacao;
    }

}

    