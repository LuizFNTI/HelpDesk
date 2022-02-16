<div class="form-group">
    <label for="subcat">Selecione a SubCategoria:</label>
    <select class="form-control" id="cscatg" name="cscat" required>
        <option value="">Selecione</option>
    <?php
        include '../Backend/conexao.php';

        //Usa o POST para atribuir o valor a condição WHERE
        $cod_categoria = $_POST['categoria'];

        $dados = array();        
                    
        //Faz a consulta e verifica qual categoria as subcategorias pertence atraves do cod_categoria passado pelo POST
        $query = $conn->prepare("SELECT * FROM subcategoria WHERE categoria_cod_categoria = ? AND ativo = 1");
        $query->execute(array($cod_categoria));
                    
        //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
            echo "<option value=".$dados['cod_subcategoria'].">".$dados['nome_subcategoria']."</option>";
        }
    ?>
    </select>
</div>