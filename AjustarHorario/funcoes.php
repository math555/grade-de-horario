<?php

    include(".\Classes\Funcionario.Class.php");
    $function = $_POST['funcao'];
    // $type = ($_POST['type'] = '') ? 'todos' : $_POST['type'];

switch ($function){    
    case 'carregaFuncionarios':
    {
        $func = new Funcionario();
        $dadosFuncionarios = $func->CarregarFuncionarios('POU_NOME');

        print json_encode($dadosFuncionarios);
        break;
    }

    case "carregarDados":
    {
        $func = new Funcionario();
        $dadosFuncionarios = $func->CarregarFuncionarios('POU_NOME');
        

        print json_encode($dadosFuncionarios);
        break;
    }
}

?>