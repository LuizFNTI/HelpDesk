<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesUser"
        aria-expanded="true" aria-controls="collapsePages">
        <img class="img-profile rounded-circle" src="img/do-utilizador.png">
        <span class="mr-2 d-none d-lg-inline text-light-600 small"><?php echo $nome_usuario; ?></span>
    </a>
    <div id="collapsePagesUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">PERFIL</h6>
            <a class="collapse-item" href="editarPerfil.php">Editar Perfil</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">SAIR</h6>
            <a class="collapse-item" href="../Backend/logout.php">Sair</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">USUÁRIO</div>

<!-- Nav Item - Pages Collapse Menu -->

<!-- Nav Item - Charts -->
<li class="nav-item" id="abrirChamado">
    <a class="nav-link" href="abrirChamado.php">
        <i class="fas fa-fw fa-plus"></i>
        <span>Abrir Chamado</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item" id="meusChamado">
    <a class="nav-link" href="listaChamadoUsuario.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Meus Chamados</span></a>
</li>

<li class="nav-item" id="pesquisarChamado">
    <a class="nav-link collapsed" href="pesquisarChamado.php">
        <i class="fas fa-fw fa-search"></i>
        <span>Pesquisar Chamado</span>
    </a>
</li>
<?php if($nivel == 1 || $nivel == 2) { ?>
<div class="sidebar-heading">ANALISTA</div>

<li class="nav-item" id="atenderChamado">
    <a class="nav-link collapsed" href="listaChamadoAnalista.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Atendimento Chamados</span>
    </a>
</li>

<li class="nav-item" id="estatistica">
    <a class="nav-link collapsed" href="estatisticaRelatorios.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Estatistica/Relatórios</span>
    </a>
</li>

<?php } if($nivel == 2) { ?>

<div class="sidebar-heading">
    ADMINISTRADOR
</div>

<li class="nav-item" id="gerenciarUsuarios">
    <a class="nav-link collapsed" href="gerenciarUsuarios.php">
        <i class="fas fa-fw fa-user"></i>
        <span>Gerenciar Usuários</span>
    </a>
</li>

<li class="nav-item" id="adicionarOpcoes">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-plus"></i>
        <span>Adicionar Opções</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">ABERTURA DE CHAMADOS</h6>
            <a class="collapse-item" href="adicionarTipo.php">Adicionar Tipo</a>
            <a class="collapse-item" href="adicionarCategoria.php">Adicionar Categoria</a>
            <a class="collapse-item" href="adicionarSubCat.php">Adicionar Sub Categoria</a>
            <a class="collapse-item" href="adicionarItem.php">Adicionar Item</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">ATENDIMENTO</h6>
            <a class="collapse-item" href="adicionarStatus.php">Adicionar Status</a>
            <a class="collapse-item" href="adicionarPrioridade.php">Adicionar Prioridade</a>
            <a class="collapse-item" href="adicionarTipoAtendimento.php">Adicionar Tipo Atendimento</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">DEPARTAMENTO</h6>
            <a class="collapse-item" href="adicionarDepartamento.php">Adicionar Departamento</a>
        </div>
    </div>
</li>

<li class="nav-item" id="adicionarOpcoes">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesOpc1"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Gerenciar Opções</span>
    </a>
    <div id="collapsePagesOpc1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">ABERTURA DE CHAMADOS</h6>
            <a class="collapse-item" href="gerenciarTipo.php">Gerenciar Tipo</a>
            <a class="collapse-item" href="gerenciarCategoria.php">Gerenciar Categoria</a>
            <a class="collapse-item" href="gerenciarSubcategoria.php">Gerenciar Subcategoria</a>
            <a class="collapse-item" href="gerenciarItem.php">Gerenciar Item</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">ATENDIMENTO</h6>
            <a class="collapse-item" href="gerenciarStatus.php">Gerenciar Status</a>
            <a class="collapse-item" href="gerenciarPrioridade.php">Gerenciar Prioridade</a>
            <a class="collapse-item" href="gerenciarTipoAtendimento.php">Gerenciar Tipo Atendimento</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">DEPARTAMENTO</h6>
            <a class="collapse-item" href="gerenciarDepartamento.php">Gerenciar Departamento</a>
        </div>
    </div>
</li>
<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
<!-- End of Sidebar -->