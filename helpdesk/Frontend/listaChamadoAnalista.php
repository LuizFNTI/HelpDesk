<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/listaChamadoAnalista.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active" id="sizefont">
        <a class="nav-link" href="listaChamadoAnalista.php">Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="pesquisarChamadoAnalista.php">Pesquisar Chamado</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="#">Gerar Relatório</a>
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
            <div id="titulo"><h3>MINHA FILA</h3></div>
            <div id="filanalista">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Chamado</th>
                            <th>Usuário</th>
                            <th>Tipo</th> 
                            <th>Categoria</th>
                            <th>Sub Categoria</th>
                            <th>Item</th>
                            <th>Descrição</th>
                            <th>Data Inicio</th>
                            <th>Data Prazo</th>
                            <th>Status</th>
                             <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td><a href="verChamadoAnalista.php">Ver</a></td>
                        </tr>
                        <tr>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td><a href="verChamadoAnalista.php">Ver</a></td>
                        </tr>
                    </tbody>
                </table>
            </div> <!--filanalista-->
            <div id="titulo"><h3>FILA GERAL</h3></div>
            <div id="filageral">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Chamado</th>
                            <th>Usuário</th>
                            <th>Tipo</th> 
                            <th>Categoria</th>
                            <th>Sub Categoria</th>
                            <th>Item</th>
                            <th>Descrição</th>
                            <th>Data Inicio</th>
                            <th>Data Prazo</th>
                            <th>Status</th>
                             <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td><a href="verChamadoAnalista.php">Ver</a></td>
                        </tr>
                        <tr>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td>Exemplo</td>
                            <td><a href="verChamadoAnalista.php">Ver</a></td>
                        </tr>
                    </tbody>
                </table>
            </div> <!--filageral-->
        </div> <!--dpc-->
    </main> 
</body>
</html>