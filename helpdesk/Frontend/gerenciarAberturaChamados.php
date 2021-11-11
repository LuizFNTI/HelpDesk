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
                            <th>Ativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        $query = $conn->query("SELECT * FROM tipo ORDER BY nome_tipo");
                    
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);

                        if(count($dados) > 0) {
                            for ($i=0; $i < count($dados); $i++) {
                    
                    echo "<tbody>";

                        foreach ($dados[$i] as $k => $v) {
                            echo "<th>".$v."</th>";
                        }
                    ?> 
                    <th>
                        <a href="verTipo.php?tipo_up=<?php echo $dados[$i] ['cod_tipo']; ?>">Ver</a> 
                    </th>
                    <?php
                    }
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
                            <th>Ativo</th>
                            <th>Tipo Associado</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        $query = $conn->query("SELECT * FROM categoria ORDER BY nome_categoria");
                    
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);

                        if(count($dados) > 0) {
                            for ($i=0; $i < count($dados); $i++) {
                    
                    echo "<tbody>";

                        foreach ($dados[$i] as $k => $v) {
                            echo "<th>".$v."</th>";
                        }
                    ?> 
                    <th>
                        <a href="verCategoria.php?categoria_up=<?php echo $dados[$i] ['cod_categoria'];?>">Ver</a> 
                    </th>
                    <?php
                    }
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
                            <th>Ativo</th>
                            <th>Categoria Associada</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        $query = $conn->query("SELECT * FROM subcategoria ORDER BY nome_subcategoria");
                    
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);

                        if(count($dados) > 0) {
                            for ($i=0; $i < count($dados); $i++) {
                    
                    echo "<tbody>";

                        foreach ($dados[$i] as $k => $v) {
                            echo "<th>".$v."</th>";
                        }
                    ?> 
                    <th>
                        <a href="verSubCategoria.php?subcategoria_up=<?php echo $dados[$i] ['cod_subcategoria'];?>">Ver</a> 
                    </th>
                    <?php
                    }
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
                            <th>Ativo</th>
                            <th>SubCategoria Associada</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        $query = $conn->query("SELECT * FROM item ORDER BY nome_item");
                    
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);

                        if(count($dados) > 0) {
                            for ($i=0; $i < count($dados); $i++) {
                    
                    echo "<tbody>";

                        foreach ($dados[$i] as $k => $v) {
                            echo "<th>".$v."</th>";
                        }
                    ?> 
                    <th>
                        <a href="verItem.php?item_up=<?php echo $dados[$i] ['cod_item'];?>">Ver</a> 
                    </th>
                    <?php
                    }
                }
                ?>
                    </tbody>
                </table>
            </div> <!--Gerenciar Item chamado-->
        </div> <!--dpc7-->
</body>
</html>