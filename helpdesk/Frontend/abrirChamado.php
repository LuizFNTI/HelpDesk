<?php
include_once '../Backend/conexao.php';

//Verifica se existe POST
if(isset($_POST['descricao'])) {

    //Pega os POSTs do form e atribui a variaveis
    
    $tipo = $_POST['tipo'];
    $categoria = $_POST['cat'];
    $subcategoria = $_POST['scat'];
    $item = $_POST['item']; 
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $prioridade = $_POST['prioridade'];
    $tipo_atendimento = $_POST['tipoa'];

    //faz a consulta no banco
    $query = $conn->prepare("INSERT INTO chamados (tipo_cod_tipo, categoria_cod_categoria, subcategoria_cod_subcategoria, item_cod_item) VALUES (:tipo, :categoria, :subcat, :item)");
    $query->bindValue(":tipo",$tipo);
    $query->bindValue(":categoria",$categoria);
    $query->bindValue(":subcat",$subcategoria);
    $query->bindValue(":item",$item);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir Chamado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/abrirChamado.css">                         
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="listaChamadoUsuario.php">Meus Chamados</a>
        </li>
        <li class="nav-item active" id="sizefont">
        <a class="nav-link" href="abrirChamado.php">Abrir Chamado</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="pesquisarChamadoUsuario.php">Pesquisar Chamados</a>
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
        <div id="form1">
        <form action="abrirChamado.php" method="POST">
        <h2>Abrir Novo Chamado</h2>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="tipodemanda">Selrcione o Tipo de Demanda</label>
                <select class="form-control" placeholder="Tipo" id="tipod" name="tipo">
                <?php
                    include '../Backend/conexao.php';

                    $dados = array();        
                    
                    //faz a consulta no banco
                    $query = $conn->query("SELECT * FROM tipo ORDER BY nome_tipo");
                    
                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_tipo'].">".$dados['nome_tipo']."</option>";
                    }
                ?>
                </select>
            </div>
        </div> <!--col1-->
        <div class="col">
            <div class="form-group">
                <label for="categoria">Selecione a Categoria:</label>
                <select class="form-control" id="catg" name="cat">
                <?php
                    include '../Backend/conexao.php';

                    //Usa o POST para atribuir o valor a condição WHERE
                    $cod_tipo = $_POST['ctipo'];

                    $dados = array();        
                    
                    //Faz a consulta e verifica qual tipo as categorias pertence atraves do cod_tipo passado pelo POST
                    $query = $conn->prepare("SELECT * FROM categoria WHERE tipo_cod_tipo = ?");
                    $query->execute(array($cod_tipo));

                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_categoria'].">".$dados['nome_categoria']."</option>";
                    }
                ?>
                </select>
            </div>
        </div> <!--col2-->
        </div> <!--row 1-->
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="subcat">Selecione a SubCategoria:</label>
                    <select class="form-control" id="scatg" name="scat">
                    <?php
                    include '../Backend/conexao.php';

                    //Usa o POST para atribuir o valor a condição WHERE
                    $cod_categoria = $_POST['ccat'];

                    $dados = array();        
                    
                    //Faz a consulta e verifica qual categoria as subcategorias pertence atraves do cod_categoria passado pelo POST
                    $query = $conn->prepare("SELECT * FROM subcategoria WHERE categoria_cod_categoria = ?");
                    $query->execute(array($cod_categoria));
                    
                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_subcategoria'].">".$dados['nome_subcategoria']."</option>";
                    }
                ?>
                    </select>
                </div>
            </div> <!--col3-->
            <div class="col">
                <div class="form-group">
                    <label for="item">Selecione o Item:</label>
                    <select class="form-control" id="items" name="item">
                    <?php
                    include '../Backend/conexao.php';

                    //Usa o POST para atribuir o valor a condição WHERE
                    $cod_subcategoria = $_POST['scat'];

                    $dados = array();        
                    
                    //Faz a consulta e verifica qual subcategoria as item pertence atraves do cod_subcategoria passado pelo POST
                    $query = $conn->prepare("SELECT * FROM item WHERE subcategoria_cod_subcategoria = ?");
                    $query->execute(array($cod_subcategoria));
                    
                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_item'].">".$dados['nome_item']."</option>";
                    }
                ?>
                    </select>
                </div>
            </div> <!--col4-->
        </div> <!--row 2-->
            <div class="form-group">
                <label for="descricao">Faça uma breve descrição da sua solicitação:</label>
                <textarea class="form-control" rows="5" placeholder="Descrição:" id="descr" name="descricao"></textarea>
            </div>
            <button type="button" class="btn btn-success">Enviar</button>
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
    <script src="JS/JQuery/jquery-3.6.0.min.js"></script>
</body>
</html>