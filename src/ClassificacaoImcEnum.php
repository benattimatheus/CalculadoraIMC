<?php

##TODO
##Pessoas abaixo de 20 anos devem ser divididos por sexo e idade
##< Percentil 5 Baixo Peso
##>=Percentil 5 e < Percentil 85 Adequado ou Eutrófico
##>= Percentil 85 Sobrepeso
##Feminino 
##Idade	Percentil	Percentil
// Idade	Percentil por idade Adolescentes Femininos				
// 	  5%	  85%			
// 10	14,23	20,19			
// 11	14,6	21,18			
// 12	14,98	22,17			
// 13	15,36	23,08			
// 14	15,67	23,88			
// 15	16,01	24,29			
// 16	16,37	24,74			
// 17	16,59	25,23			
// 18	16,71	25,56			
// 19	16,87	25,85			
##Masculino
// Idade	Percentil por idade Adolescentes Masculinos				
// 	     5%	     85%			
// 10	14,42	19,6			
// 11	14,83	20,35			
// 12	15,24	21,12			
// 13	15,73	21,93			
// 14	16,18	22,77			
// 15	16,59	23,63			
// 16	17,01	24,45			
// 17	17,31	25,28			
// 18	17,54	25,95			
// 19	17,8	26,36			


enum ClassificacaoImcEnum: string
{
    case Magreza            = 'Magreza';
    case Normal             = 'Normal';
    case Sobrepeso          = 'Sobrepeso';
    case ObesidadeGrauI     = 'Obesidade grau I';
    case ObesidadeGrauII    = 'Obesidade grau II';
    case ObesidadeGrauIII   = 'Obesidade grau III';

    public static function classifica(float $imc): string
    {

        if ($imc >= 40) {
            return 'Obesidade grau III';
        }

        if ($imc >= 35 && $imc < 40) {
            return 'Obesidade grau II';
        }

        if ($imc >= 30 && $imc < 35) {
            return 'Obesidade grau I';
        }

        if ($imc >= 25 && $imc < 30) {
            return 'Sobrepeso';
        }

        if ($imc >= 18.5 && $imc < 25) {
            return 'Normal';
        }

        if ($imc < 18.5) {
            return  'Magreza';
        }
    }
}
