<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-light-600 small"><?php echo $nome_usuario; ?></span>
        <img class="img-profile rounded-circle" src="img/undraw_profile.png">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="editarPerfil.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Configurações
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../Backend/logout.php" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Sair
        </a>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">USUÁRIO</div>

<!-- Nav Item - Pages Collapse Menu -->

<!-- Nav Item - Charts -->
<li class="nav-item" id="abrirchamado">
    <a class="nav-link" href="abrirChamado.php">
        <i class="fas fa-fw fa-plus"></i>
        <span>Abrir Chamado</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="listaChamadoUsuario.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Meus Chamados</span></a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="pesquisarChamado.php">
        <i class="fas fa-fw fa-search"></i>
        <span>Pesquisar Chamado</span>
    </a>
</li>
<?php if($nivel == 1 || $nivel == 2) { ?>
<div class="sidebar-heading">ANALISTA</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="listaChamadoAnalista.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Atendimento Chamados</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="estatisticaRelatorios.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Estatistica/Relatórios</span>
    </a>
</li>

<?php } if($nivel == 2) { ?>

<div class="sidebar-heading">
    ADMINISTRADOR
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="gerenciarUsuarios.php">
        <i class="fas fa-fw fa-user"></i>
        <span>Gerenciar Usuários</span>
    </a>
</li>

<li class="nav-item">
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

<li class="nav-item">
    <a class="nav-link collapsed" href="gerenciarAberturaChamados.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Gerenciar Abertura</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="gerenciarSistemaChamados.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Sistema de Chamados</span>
    </a>
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