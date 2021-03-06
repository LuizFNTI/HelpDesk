<div class="form-group">
    <label for="categoria">Selecione a Categoria:</label>
    <select class="form-control" id="ccatg" name="ccat" required>
        <option value="">Selecione</option>
    <?php
        include '../Backend/conexao.php';

        //Usa o POST eviado por Ajax para atribuir o valor a condição WHERE
        $cd_tipo = $_POST['tipo'];
                    
        $dados = array(); 
                    
        //Faz a consulta e verifica qual tipo as categorias pertence atraves do cod_tipo passado pelo POST
        $query = $conn->prepare("SELECT * FROM categoria WHERE tipo_cod_tipo = ? AND ativo = 1 ORDER BY nome_categoria");
        $query->execute(array($cd_tipo));

        //Carrega os dados do array no option
        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
            echo "<option value=".$dados['cod_categoria'].">".$dados['nome_categoria']."</option>";
        }
    ?>
    </select>
</div>