<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tipo Demanda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/gerenciarSistema.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarSistemaChamado.php">Gerenciar Sistema de Chamados</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="gerenciarUsuarios.php">Gerenciar Usuários</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link active" href="gerenciarSistema">Gerenciar cadastro Demandas</a>
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
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="d1">
        <p><a href="adicionarTipo.php">Adicionar Novo Tipo</a></p>
        <p><a href="adicionarCategoria.php">Adicionar Nova Categogoria</a></p>
        <p><a href="adicionarSubCat.php">Adicionar Nova Sub Categoria</a></p>
        <p><a href="adicionarItem.php">Adicionar Novo Item</a></p>
        <p><a href="adicionarTipoAtendimento.php">Adicionar Novo Tipo Atendimento</a></p>
        <p><a href="adicionarStatus.php">Adicionar Novo Status</a></p>
    </div> <!--d1-->
    </div> <!--dpc-->
    </main>
</body>
</html>