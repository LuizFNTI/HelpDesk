<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Chamado Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/gerenciarSistemaChamado.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarSistemaChamado.php">Gerenciar Sistema de Chamados</a>
        </li>
        <li class="nav-item active" id="sizefont">
        <a class="nav-link" href="gerenciarAberturaChamados.php">Gerenciar Abertura de Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarUsuarios.php">Gerenciar Usuários</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarSistema">Gerenciar cadastro Demandas</a>
        </li>
        <li class="nav-item" id="btconfg">
            <button type="button" class="btn btn-primary">Configurações</button>
        </li>
        <li class="nav-item" id="btsair">
            <button type="button" class="btn btn-danger">Sair</button>
        </li>
    </ul>
    </nav>
    <div id="bemv"><p>Olá, nomeUsuario</p></div>
    <div class="row justify-content-center align-items-center">
        <div id="dpc5">
            <div id="gerenciarTipo">
                <div id="titulo"><h2>Gerenciar Tipo chamado</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo Tipo</th>
                            <th>Nome Tipo</th>
                            <th>Ativo/Inativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM tipo ORDER BY nome_tipo");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_tipo']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verTipo.php?tipo_up=".$dados['cod_tipo'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--Gerenciar Tipo chamado-->
        </div> <!--dpc5-->
        <div class="row justify-content-center align-items-center">
        <div id="dpc6">
            <div id="gerenciarCategoria">
                <div id="titulo"><h2>Gerenciar Categoria Chamado</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo Categoria</th>
                            <th>Nome Categoria</th>
                            <th>Tipo Associado</th>
                            <th>Ativo/Inativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT categoria.cod_categoria, categoria.nome_categoria, tipo.nome_tipo, categoria.ativo FROM categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_categoria']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_categoria']."</th>";
                                echo "<th>".$dados['nome_tipo']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verCategoria.php?categoria_up=".$dados['cod_categoria'].">Ver</a></th>";
                            echo "</tr>";
                        } 
                    ?>
                    </tbody>
                </table>
            </div> <!--Gerenciar Categoria chamado-->
        </div> <!--dpc6-->
        <div class="row justify-content-center align-items-center">
        <div id="dpc7">
            <div id="gerenciarSubCategoria">
                <div id="titulo"><h2>Gerenciar SubCategoria Chamado</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo SubCategoria</th>
                            <th>Nome SubCategoria</th>
                            <th>Categoria Associada</th>
                            <th>Tipo Associado</th>
                            <th>Ativo/Inativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT subcategoria.cod_subcategoria, subcategoria.nome_subcategoria, categoria.nome_categoria, tipo.nome_tipo, subcategoria.ativo FROM subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_subcategoria']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_subcategoria']."</th>";
                                echo "<th>".$dados['nome_categoria']."</th>";
                                echo "<th>".$dados['nome_tipo']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verSubcategoria.php?subcategoria_up=".$dados['cod_subcategoria'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--Gerenciar SubCategoria chamado-->
        </div> <!--dpc7-->
        <div class="row justify-content-center align-items-center">
        <div id="dpc8">
            <div id="gerenciarItem">
                <div id="titulo"><h2>Gerenciar Item Chamado</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo Item</th>
                            <th>Nome Item</th>
                            <th>SubCategoria Associada</th>
                            <th>Categoria Associada</th>
                            <th>Tipo Associado</th>
                            <th>Ativo/Inativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT item.cod_item, item.nome_item, subcategoria.nome_subcategoria, categoria.nome_categoria, tipo.nome_tipo, item.ativo FROM item INNER JOIN subcategoria ON subcategoria.cod_subcategoria = item.subcategoria_cod_subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_item']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_item']."</th>";
                                echo "<th>".$dados['nome_subcategoria']."</th>";
                                echo "<th>".$dados['nome_categoria']."</th>";
                                echo "<th>".$dados['nome_tipo']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verItem.php?item_up=".$dados['cod_item'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--Gerenciar Item chamado-->
        </div> <!--dpc7-->
</body>
</html>