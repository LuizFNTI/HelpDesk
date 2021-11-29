<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
        $nome_analista = $_SESSION['usuario'][2];
    } else {
        header("location: ../index.php");
    }

    include '../Backend/conexao.php';

    $resultado = array();

    //Pega o codigo tipo pela URL
    $numero_chamado_up = $_GET['nc_up'];
        
    //Faz o select para passar os valores para o form
    $query = $conn->prepare("SELECT
        chamados.numero_chamado,
        tipo.nome_tipo,
        categoria.nome_categoria,
        subcategoria.nome_subcategoria,
        item.nome_item,
        chamados.descricao,
        chamados.data_hora_abertura,
        chamados.data_hora_prazo,
        usuarios.nome,
        prioridade_chamado.nome_prioridade,
        status_chamado.nome_status
    FROM
        chamados
    INNER JOIN item ON item.cod_item = chamados.item_cod_item
    INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
    INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
    INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
    INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
    INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status WHERE numero_chamado = :nc");
    $query->bindValue(":nc",$numero_chamado_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['status'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $descricao_analista = $_POST['descanalista'];
        $data_hora_prazo = $_POST['dhprazo'];
        $status = $_POST['status'];
        $prioridade = $_POST['prioridade'];
        $tipo_atendimento = $_POST['tipoa'];
        $fila_geral = $_POST['fgeral'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao_analista = :dn, data_hora_prazo = :dhp, analista = :analista, status_chamado_cod_status = :cs, prioridade_chamado_cod_prioridade = :cp, tipo_atendimento_cod_tipo_atendimento = :cta, aberto = :aberto, fila_geral = :fgeral WHERE cod_tipo = :ct");
        $query->bindValue(":dn",$descricao_analista);
        $query->bindValue(":dhp",$data_hora_prazo);
        $query->bindValue(":analista",$nome_analista);
        $query->execute();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Chamado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/verChamadoAnalista.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
        <div id="dpc">
            <div class="row">
                <div class="col">
                    <div id="numchamado">
                        Aqui Ficara o Número do Chamado
                    </div><br>
                    <div id= "infodemanda">
                        <div class="row">
                        <p>Tipo</p>>
                        <p>Categoria</p>>
                        <p>SubCategoria</p>>
                        <p>Item</p>
                        </div> <!--row-->
                    </div>
                    <div id="usuario">
                        Aqui ficara as informações do Usuário
                    </div><br><br><br><br>
                    <div id="descricao">
                        Aqui ficara a descrição do Usuário
                    </div>
                </div> <!--col-->
                <div class="col">
                    <p>Data e Hora abertura</p>
                    <p>Data prazo</p>
                    <p>Alterar Prioridade</p>
                    <p>Selecionar Tipo Atendimento</p>
                    <p>Selecionar Status</p><br><br><br>
                    <div>Descrição Analista</div>
                </div>
            </div> <!--row-->
            <div id="bt"><button type="button" class="btn btn-success">Salvar Alterações</button></div>
        </div> <!--dpc-->
    </main>
</body>
</html>