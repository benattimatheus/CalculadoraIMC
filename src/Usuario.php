<?php

class Usuario{
    private string $nome;
    private DateTimeInterface $dataNascimento;
    private float $peso;
    private float $altura;
    private SexoEnum $sexo;
    
    public function __construct(string $nome, DateTimeInterface $dataNascimento, float $peso, float $altura, SexoEnum $sexo){
        $this->nome=$nome;
        $this->dataNascimento = $dataNascimento;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->sexo = $sexo;
    }
    
    public function getNome():string{
        return $this->nome;
    }
    
    public function getDataNascimento():DateTimeInterface{
        return $this->dataNascimento;
    }
    
    public function getPeso():float{
        return $this->peso;
    }
    
    public function getAltura():float{
        return $this->altura;
    }
    
    public function getSexo():SexoEnum{
        return $this->sexo;
    }
    
    public function getIdadeAtual(){
        return $this->dataNascimento->diff(new DateTimeImmutable(date('Y-m-d')))->y;
    }

    public function validarDadosEntrada() {
        if (empty($this->nome) || empty($this->peso) || empty($this->altura) || empty($this->sexo) || empty($this->dataNascimento)) {
            throw new ExemploException('Todos os campos são obrigatórios.', 1);
        }

        if (!is_numeric($this->peso) || $this->peso <= 0) {
            throw new ExemploException('O peso deve ser um número positivo.', 2);
        }

        if (!is_numeric($this->altura) || $this->altura <= 0) {
            throw new ExemploException('A altura deve ser um número positivo.', 3);
        }

        if ($this->dataNascimento > new DateTimeImmutable()) {
            throw new ExemploException('A data de nascimento não pode estar no futuro.', 4);
        }
    }

    public function calcularIMC() {
        if ($this->altura == 0) {
            throw new ExemploException('Altura não pode ser zero.', 5);
        }
    
        return $this->peso / ($this->altura * $this->altura);
    }
}