<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarItem.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="adicionarItem.php" method="POST">
        <h2>Cadastrar Novo Item</h2>
        <div class="form-group">
                <label for="tipodemanda">Selrcione o Tipo de Demanda</label>
                <select class="form-control" id="cdt" name="ctipo">
                <?php
                    include '../Backend/conexao.php';

                    $dados = array();        
                    
                    $query = $conn->query("SELECT * FROM tipo ORDER BY nome_tipo");
                    
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_tipo'].">".$dados['nome_tipo']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="categoria">Selecione a Categoria:</label>
                <select class="form-control" id="ccatg" name="ccat">
                <?php
                    include '../Backend/conexao.php';

                    $cod_tipo = $_POST['ctipo'];

                    $dados = array();        
                    
                    $query = $conn->prepare("SELECT * FROM categoria WHERE tipo_cod_tipo = ?");
                    $query->execute(array($cod_tipo));

                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_categoria'].">".$dados['nome_categoria']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="subcat">Selecione a SubCategoria:</label>
                <select class="form-control" id="cscatg" name="cscat">
                <?php
                    include '../Backend/conexao.php';

                    $cod_categoria = $_POST['ccat'];

                    $dados = array();        
                    
                    $query = $conn->prepare("SELECT * FROM subcategoria WHERE categoria_cod_categoria = ?");
                    $query->execute(array($cod_categoria));
                    
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_subcategoria'].">".$dados['nome_subcategoria']."</option>";
                    }
                ?>
                </select>
                </div>
                <div class="form-group">
                <label for="nitem">Digite o Novo Item</label>
                <input type="text" class="form-control" placeholder="Novo Item:" name="novoi" id="ni" required>
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label><br>
                <select class="form-control" id="atv" name="ativo">
                    <option value="0">Inativo</option>
                    <option value="1">Ativo</option>
                </select>
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>