<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- jquery -->
    <script src="js/jQuery/jquery-3.3.1.js"></script>
    <script src="js/jQuery/jquery-3.3.1.min.js"></script>

    <!-- toast -->
    <link rel="stylesheet" href="js/toast/jquery.toast.css">
    <script src="js/toast/jquery.toast.js"></script>

    <link rel="icon" type="imagem/png" href="icon/poupaIcon.png" />
    <title>Poupatempo :D</title>
    <style>
        .red-pausa {
            background-color: #ff0000e3 !important;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    include("conexao.php");

    ?>
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="icon/poupaIcon.png" width="100" height="50" class="d-inline-block align-top" alt="">
            </a>
            <a class="float-right">
                <select class="form-select" aria-label="Default select example">
                    <optgroup label="Setor">
                        <option selected>Todos</option>
                        <option value="1">Detran</option>
                        <option value="2">IRGD</option>
                        <option value="3">Triagem</option>
                    </optgroup>
                    <optgroup label="Tipo">
                        <option value="1">Mensalista</option>
                        <option value="2">Horista</option>
                    </optgroup>
                </select>
            </a>
        </nav>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="grade-tab" data-toggle="tab" href="#grade" role="tab" aria-controls="grade" aria-selected="true">Grade de Funcionarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="alteracao-tab" data-toggle="tab" href="#alteracao" role="tab" aria-controls="alteracao" aria-selected="false">Alteração de Dados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="baixas-tab" data-toggle="tab" href="#baixas" role="tab" aria-controls="baixas" aria-selected="false">Baixas</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="grade" role="tabpanel" aria-labelledby="grade-tab">
                <!-- criado no js (exibirHorarios) -->
            </div>
            <div class="tab-pane fade" id="alteracao" role="tabpanel" aria-labelledby="alteracao-tab">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="input-group mb-3 mt-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nome</span>
                            </div>
                            <input type="text" id="nome-funcionario" class="form-control" placeholder="Username" aria-label="Nome" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Pausa</span>
                            </div>
                            <input type="text" id="pausa-funcionario" class="form-control" placeholder="Horario da Pausa" aria-label="Horario da Pausa" aria-describedby="basic-addon1">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Retorno</span>
                            </div>
                            <input type="text" id="retorno-funcionario" class="form-control" placeholder="Horario de Retorno" aria-label="Horario de Retorno" aria-describedby="basic-addon1">
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="submit" id="btnSalvar" class="btn btn-secondary mb-2">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="grade-tab">
                            <div class="list-group" id="list-funcionarios">
                                <!-- criado no js (listarFuncionarios) -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="baixas" role="tabpanel" aria-labelledby="baixas-tab">baixas</div>
        </div>
    </div>
</body>
<script>
    var arrayDados = [];

    function exibirHorarios() {

        $.ajax({
            type: "POST",
            url: "funcoes.php",
            data: {
                funcao: 'carregaFuncionarios',
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                data.forEach(function(obj) {
                    console.log(obj)
                    //criando o card
                    var div = document.createElement('div')
                    div.classList.add("card")

                    //criando o corpo do card
                    var divBody = document.createElement('div')
                    divBody.classList.add("card-body")

                    //criando campo para exibir nome
                    var h5 = document.createElement('span')
                    h5.classList.add('card-title')
                    h5.innerText = obj.nome

                    //criando informações de saida e retorno
                    var spanSaida = document.createElement('span')
                    spanSaida.classList.add('badge')
                    spanSaida.classList.add('badge-danger')
                    spanSaida.classList.add('float-right')
                    spanSaida.innerText = "Saida: " + obj.saida

                    var spanRetorno = document.createElement('span')
                    spanRetorno.classList.add('badge')
                    spanRetorno.classList.add('badge-success')
                    spanRetorno.classList.add('float-right')
                    spanRetorno.innerText = "Retorno: " + obj.retorno

                    //adicionando informações do funcionario ao corpo do card
                    divBody.append(h5, spanRetorno, spanSaida)

                    //adicionando o corpo ao card
                    div.append(divBody)

                    $("#grade").append(div);
                })
            },
            error: function(request, status, error) {
                console.log(request.responseText, error);
            }
        });
    }

    function listarFuncionarios() {

        $.ajax({
            type: "POST",
            url: "funcoes.php",
            data: {
                funcao: 'carregarDados',
            },
            dataType: 'json',
            success: function(data) {
                arrayDados = data;
                data.forEach(function(obj) {
                    var elm = document.createElement('a');
                    elm.classList.add('list-group-item');
                    elm.classList.add('list-group-item-action');
                    elm.href = '#';
                    elm.innerHTML = obj.nome;
                    elm.id = obj.id;

                    elm.onclick = function() {
                        console.log(obj.id);
                        alteraDados(obj.id)
                    }
                    $("#list-funcionarios").append(elm);
                });
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    }

    function alteraDados(id) {
        var found = arrayDados[id];
        $("#nome-funcionario").val($("#" + id).text());
        $("#pausa-funcionario").val(found.saida);
        $("#retorno-funcionario").val(found.retorno);
    }

    function toast(type, message) {
        switch (type) {
            case 'info':
                var toast = $.toast({
                    heading: 'Information',
                    text: message,
                    icon: 'info'
                })

                return toast
                break;

            case 'warning':
                var toast = $.toast({
                    heading: 'Warning',
                    text: message,
                    icon: 'warning'
                })

                return toast
                break;

            case 'error':
                var toast = $.toast({
                    heading: 'Error',
                    text: message,
                    icon: 'error'
                })

                return toast
                break;
            case 'sucess':
                var toast = $.toast({
                    heading: 'Success',
                    text: message,
                    icon: 'success'
                })

                return toast
                break;
        }
    }

    $(document).ready(function() {
        exibirHorarios();
        listarFuncionarios();
    });
</script>

</html>