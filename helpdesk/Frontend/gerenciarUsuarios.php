<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
        $nome_analista = $_SESSION['usuario'][2];
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
    <title>home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/gerenciarUsuario.css">

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarSistemaChamado.php">Gerenciar Sistema de Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarAberturaChamados.php">Gerenciar Abertura de Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link active" href="gerenciarUsuarios.php">Gerenciar Usuários</a>
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
    <main class="row justify-content-center align-items-center">
        <div id="dpc">
            <div id="listaUsuarios">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nome Usuário</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Departamento</th>
                            <th>Nivel de Acesso</th>
                            <th>Status no Sistema</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM usuarios INNER JOIN departamento ON departamento.cod_departamento = usuarios.departamento");

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['matricula']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome']."</th>";
                                echo "<th>".$dados['telefone']."</th>";
                                echo "<th>".$dados['email']."</th>";
                                echo "<th>".$dados['nome_departamento']."</th>";
                                if($dados['nivel'] == 0) {echo "<th>Usuário</th>";} else if($dados['nivel'] == 1) {echo "<th>Analista</th>";} else {echo "<th>Administrador</th>";}
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verUsuario.php?matricula_up=".$dados['matricula'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!--listaUsuarios-->
        </div> <!--dpc-->
    </main> 
</body>
</html>