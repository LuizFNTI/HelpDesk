<div class="form-group">
    <label for="tipodemanda">Selecione o Tipo de Demanda</label>
    <select class="form-control" id="cdt" name="ctipo" required>
        <option value="">Selecione</option>
    <?php
        include '../Backend/conexao.php';

        $dados = array();        
                    
        //Faz a consulta no banco
        $query = $conn->query("SELECT * FROM tipo WHERE ativo = 1 ORDER BY nome_tipo");
                    
        //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
            echo "<option value=".$dados['cod_tipo'].">".$dados['nome_tipo']."</option>";
        }
    ?>
    </select>
</div>