<?php

require_once__DIR__.'/src/Usuario.php';

require_once__DIR__.'/src/CalculadoraImc.php';

require_once__DIR__.'/src/SexoEnum.php';

require_once__DIR__.'/src/ClassificacaoImcEnum.php';

$usuario = new Usuario('Joao', new DateTimeImmutable('2001-01-01'), 150, 1.80, SexoEnum::M);

$calculadoraImc = new calculadoraImc($usuario);

print_r(ClassificacaoImcEnum::classifica($calculadoraImc->calcular()));
