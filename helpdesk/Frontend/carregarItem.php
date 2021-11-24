<div class="form-group">
    <label for="item">Selecione o Item:</label>
    <select class="form-control" id="idtem" name="item">
    <?php
    include '../Backend/conexao.php';

    //Usa o POST para atribuir o valor a condição WHERE
    $cod_subcategoria = $_POST['item'];

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