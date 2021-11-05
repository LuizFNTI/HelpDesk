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
                            <th>Senha</th>
                            <th>Nivel de Acesso</th>
                            <th>Status no Sistema</th>
                             <th>Ação</th>
                        </tr>
                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        $query = $conn->query("SELECT * FROM usuarios ORDER BY nome");

                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);

                        if(count($dados) > 0) {
                            for ($i=0; $i < count($dados); $i++) {
                    
                    echo "<tbody>";

                        foreach ($dados[$i] as $k => $v) {
                            echo "<th>".$v."</th>";
                        }
                    ?> 
                    <th>
                        <a href="verUsuario.php?matricula_up=<?php echo $dados[$i] ['matricula']; ?>">Editar</a> 
                    </th>
                    <?php
                    }
                }
                ?>
                    </tbody>
                </table>
            </div> <!--listaUsuarios-->
        </div> <!--dpc-->
    </main> 
</body>
</html>