<?php

class CalculadoraImc{
    private Usuario $usuario;
    
    public function __construct(Usuario $usuario){
        $this->usuario=$usuario;
    }

    public fucntion calcular(): float{
        return $this->usuario->getPeso()/($this->usuario->getAltura()*$this->usuario->getAltura());
    }
}
