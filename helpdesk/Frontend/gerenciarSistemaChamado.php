<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Chamado Usuário</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <link rel="stylesheet" href="Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="CSS/gerenciarSistemaChamado.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active" id="sizefont">
        <a class="nav-link" href="gerenciarSistemaChamado.php">Gerenciar Sistema de Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
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
        <div id="dpc1">
            <div id="tipodemanda">
                <div id="titulo"><h2>Visão Geral</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>SubCategoria</th>
                            <th>Item</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT tipo.nome_tipo, categoria.nome_categoria, subcategoria.nome_subcategoria, item.nome_item FROM item INNER JOIN subcategoria ON subcategoria.cod_subcategoria = item.subcategoria_cod_subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['nome_tipo']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_categoria']."</th>";
                                echo "<th>".$dados['nome_subcategoria']."</th>";
                                echo "<th>".$dados['nome_item']."</th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--tipodemanda-->
        </div> <!--dpc1-->
        <div class="row justify-content-center align-items-center">
        <div id="dpc2">
            <div id="status">
                <div id="titulo"><h2>Gerenciar Status</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Status</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM status_chamado ORDER BY nome_status");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_status']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_status']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verStatus.php?status_up=".$dados['cod_status'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--status-->
        </div> <!--dpc2-->
        <div class="row justify-content-center align-items-center">
        <div id="dpc3">
            <div id="tipoatendimento">
                <div id="titulo"><h2>Gerenciar Tipo Atendimento</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Tipo Atendimento</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM tipo_atendimento ORDER BY nome_tipo_atendimento");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_tipo_atendimento']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo_atendimento']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verTipoAtendimento.php?tipoa_up=".$dados['cod_tipo_atendimento'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--tipoatendimento-->
        </div> <!--dpc3-->
        <div class="row justify-content-center align-items-center">
        <div id="dpc4">
            <div id="prioridade">
                <div id="titulo"><h2>Gerenciar Prioridade</h2></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Prioridade</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM prioridade_chamado ORDER BY nome_prioridade");
                    
                        echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_prioridade']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_prioridade']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verPrioridade.php?prioridade_up=".$dados['cod_prioridade'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--Prioridade-->
        </div> <!--dpc4-->
    </div> 
    </div> 
</body>
</html>