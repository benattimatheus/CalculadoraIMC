<?php

require_once__DIR__.'/src/Usuario.php';

require_once__DIR__.'/src/CalculadoraImc.php';

require_once__DIR__.'/src/SexoEnum.php';

require_once__DIR__.'/src/ClassificacaoImcEnum.php';

$usuario = new Usuario(nome: $_POST['idNome'], peso: $_POST['idPeso'], altura: $_POST['idAltura'],
    sexo: SexoEnum::from($_POST['idSexo']), dataNascimento: new DateTimeImmutable($_POST['idDataNasc']));

$calculadora = new CalculadoraImc($usuario);

$resultado = ClassificacaoImcEnum::classifica($calculadora->calcular());

$template = file_get_contents(__DIR__.'/src/templates/resultado.html');

$template = str_replace(
    [
        '{{USUARIO}}',
        '{{PESO}}',
        '{{ALTURA}}',
        '{{IDADE}}',
        '{{SEXO}}',
        '{{ICM}}',
        '{{CLASSIFICACAO}}'
    ],

    [
        $usuario->getNome(),
        $usuario->getPeso(),
        $usuario->getAltura(),
        $usuario->getIdadeAtual(),
        $usuario->getSexo()->value,
        $calculadora->calcular(),
        $resultado
    ],

    $template);

echo $template;