<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
    } else {
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Chamado Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/listaChamadoUsuario.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active" id="sizefont">
        <a class="nav-link" href="listaChamadoUsuario.php">Meus Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="abrirChamado.php">Abrir Chamado</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="pesquisarChamadoUsuario.php">Pesquisar Chamados</a>
        </li>
        <li class="nav-item" id="btconfg">
            <button type="button" class="btn btn-primary">Configurações</button>
        </li>
        <li class="nav-item" id="btsair">
            <a href="../Backend/logout.php">Sair</a>
        </li>
    </ul>
    </nav>
    <div id="bemv"><?php echo $matricula ?></p></div>
    <main class="row justify-content-center align-items-center">
        <div id="dpc">
            <div id="listaUsuario">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Chamado</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Sub Categoria</th>
                            <th>Item</th>
                            <th>Descrição</th>
                            <th>Data Inicio</th>
                            <th>Data Prazo</th>
                            <th>Analista Respossável</th>
                            <th>Status</th>
                             <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->prepare("SELECT
                        chamados.numero_chamado,
                        tipo.nome_tipo,
                        categoria.nome_categoria,
                        subcategoria.nome_subcategoria,
                        item.nome_item,
                        chamados.descricao,
                        chamados.data_hora_abertura,
                        chamados.data_hora_prazo,
                        chamados.analista,
                        status_chamado.nome_status,
                        usuarios.matricula
                    FROM
                        chamados
                    INNER JOIN item ON item.cod_item = chamados.item_cod_item
                    INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
                    INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
                    INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
                    INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
                    INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
                    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status WHERE matricula = ?");
                    $query->execute(array($matricula));

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['numero_chamado']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo']."</th>";
                                echo "<th>".$dados['nome_categoria']."</th>";
                                echo "<th>".$dados['nome_subcategoria']."</th>";
                                echo "<th>".$dados['nome_item']."</th>";
                                echo "<th>".$dados['descricao']."</th>";
                                echo "<th>".$dados['data_hora_abertura']."</th>";
                                echo "<th>".$dados['data_hora_prazo']."</th>";
                                echo "<th>".$dados['analista']."</th>";
                                echo "<th>".$dados['nome_status']."</th>";
                                //echo "<th><a href=verUsuario.php?matricula_up=".$dados['matricula'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--filanalista-->
        </div> <!--dpc-->
    </main> 
</body>
</html>
