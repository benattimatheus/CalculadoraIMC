<?php

require_once __DIR__ . '/src/Usuario.php';
require_once __DIR__ . '/src/CalculadoraImc.php';
require_once __DIR__ . '/src/SexoEnum.php';
require_once __DIR__ . '/src/ClassificacaoImcEnum.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $sexo = $_POST['sexo'];
    $dataNasc = $_POST['dataNasc'];

    if (empty($nome) || empty($peso) || empty($altura) || empty($sexo) || empty($dataNasc)) {
        $template = file_get_contents(__DIR__ . '/src/templates/resultado.html');

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
                'Todos os campos devem ser preenchidos',
                '',
                '',
                '',
                '',
                '',
                ''
            ],
            $template
        );


        echo $template;
        exit;
    }

    $usuario = new Usuario(
        nome: $_POST['nome'],
        peso: $_POST['peso'],
        altura: $_POST['altura'],
        sexo: SexoEnum::from($_POST['sexo']),
        dataNascimento: new DateTimeImmutable($_POST['dataNasc'])
    );

    if ($altura < 0.8 || $altura > 3.0) {
        $template = file_get_contents(__DIR__ . '/src/templates/resultado.html');

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
                '',
                'Insira uma altura válida (Entre 0.8 m e 3.0 m)',
                $usuario->getIdadeAtual(),
                $usuario->getSexo()->value,
                '',
                ''
            ],
            $template
        );

        echo $template;
        exit;
    } else if ($peso > 650) {
        $template = file_get_contents(__DIR__ . '/src/templates/resultado.html');

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
                'Insira um peso válido (Até 650kg)',
                '',
                '',
                '',
                '',
                ''
            ],
            $template
        );
        echo $template;
        exit;
    } else {


        $calculadora = new CalculadoraImc($usuario);
        $resultado = $calculadora->classificarPorFaixaEtariaSexo();

        // 1) ler o template de resposta
        $template = file_get_contents(__DIR__ . '/src/templates/resultado.html');

        // 2) trocar cada valor estatico pelo valor do script
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
            $template
        );


        echo $template;
    }
}
