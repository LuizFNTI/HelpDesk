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
    $query = $conn->prepare("SELECT * FROM
        chamados
    INNER JOIN item ON item.cod_item = chamados.item_cod_item
    INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
    INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
    INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
    INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
    INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status 
    WHERE numero_chamado = :nc");
    $query->bindValue(":nc",$numero_chamado_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['descricao'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $numero_chamado = $_POST["vnc"];
        $descricao = $_POST['descricao'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao = :du,  WHERE numero_chamado = :nc");
        $query->bindValue(":du",$descricao);
        $query->bindValue(":nc",$numero_chamado);
        $query->execute();
    }
    //caso a variavel seja nula, volta para a tela de gerenciamento
    if($numero_chamado_up == null) {
        header("location: listaChamadoUsuario.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Chamado Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/verChamadoUsuario.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
        <div id="dpc">
            <div class="row">
                <div class="col">
                    <div id="numchamado">
                        <p>Numero Chamado: <?php echo $resultado['numero_chamado']; ?></p>
                    </div><br>
                    <div id= "infodemanda">
                        <div class="row">
                        <p><?php echo $resultado['nome_tipo']; ?></p>>
                        <p><?php echo $resultado['nome_categoria']; ?></p>>
                        <p><?php echo $resultado['nome_subcategoria']; ?></p>>
                        <p><?php echo $resultado['nome_item']; ?></p>
                        </div> <!--row-->
                    </div>
                    <div id="usuario">
                        <p><?php echo $resultado['analista']; ?></p>
                    </div><br><br><br><br>
                    <div id="descricao">
                    <form action="verChamadoUsuario.php" method="POST">
                        <div class="form-group">
                        <label for="descricao">Edite a descrição da sua solicitação:</label>
                        <textarea class="form-control" rows="5" placeholder="Descrição:" id="descr" name="descricao" value="<?php echo $resultado['descricao']; ?>"></textarea>
                        </div>
                        <input type="submit" value="Editar">
                    </form>
                    </div>
                </div> <!--col-->
                <div class="col">
                    <p>Data e Hora abertura: <?php echo $resultado['data_hora_abertura']; ?></p>
                    <p>Data prazo: <?php echo $resultado['data_prazo']; ?></p><br><br><br><br><br>
                    <p>Resposta Analista: <?php echo $resultado['descricao_analista']; ?></p>
                </div>
            </div> <!--row-->
        </div> <!--dpc-->
    </main>
</body>
</html>