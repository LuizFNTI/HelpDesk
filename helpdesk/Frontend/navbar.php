<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">USUÁRIO</div>

<!-- Nav Item - Pages Collapse Menu -->

<!-- Nav Item - Charts -->
<li class="nav-item">
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