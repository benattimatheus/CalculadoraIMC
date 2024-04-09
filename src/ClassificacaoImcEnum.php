<?php

enum ClassificacaoImcEnum: string{
    case Magreza = 'Magreza';
    case Normal = 'Normal';
    case Sobrepeso = 'Sobrepeso';
    case ObesidadeGrauI = 'Obesidade Grau I';
    case ObesidadeGrauII = 'Obesidade Grau II';
    case ObesidadeGrauIII = 'Obesidade Grau III';
    
    public static function classifica(float $imc, SexoEnum $sexo, integer $idade): string{
        if ($idade > 20){    
            if ($imc>=40){
                return 'Obesidade grau III';
            }
            if ($imc>=35 && $imc<40){
                return 'Obesidade grau II';
            }
            if ($imc>=30 && $imc<35){
                return 'Obesidade grau I';
            }
            if ($imc>=25 && $imc<30){
                return 'Sobrepeso';
            }
            if ($imc>=18.5 && $imc<25){
                return 'Normal';
            }
            if ($imc<18.5){
                return 'Magreza';
            }
        }
        if ($sexo == "Masculino") {
            if($idade == 10){
                if ($imc) {
                    # code...
                }
            }
        }
    }
}