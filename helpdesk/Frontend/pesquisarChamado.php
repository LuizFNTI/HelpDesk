<form action="abrirChamado.php" method="POST" class="user">
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="form-group">
                <label for="pchamado">Numero do Chamado</label>
                <input type="text" class="form-control" placeholder="Numero Chamado:" name="numCha" id="nch" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="nomeusuario">Nome do Usuário</label>
                <input type="text" class="form-control" placeholder="Nome Chamado:" name="nomeu" id="nu" required>
            </div>      
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="form-group">
                <label for="datafinal">Data Inicial</label>
                <input type="date" class="form-control" name="datain" id="din" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="datainicial">Data Final</label>
                <input type="date" class="form-control" name="datafim" id="dfim" required>
            </div>
        </div>
    </div>
    <a href="login.html" class="btn btn-primary btn-user btn-block"> Register Account</a>
</form>