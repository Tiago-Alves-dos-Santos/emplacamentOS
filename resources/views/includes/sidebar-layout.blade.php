<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-start" href="index.html">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="{{asset('img/logo.png')}}" class="img-fluid" alt="">

        </div>
        <div class="sidebar-brand-text ml-1">emplacament<span class="fw-bolder">OS</span></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if($page_active == 'home') active @endif">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pessoal
    </div>

    <li class="nav-item @if($page_active == 'user.dashboard') active @endif">
        <a class="nav-link" href="{{route('view.user.dashboard')}}">
            <i class="fa-solid fa-user"></i>
            <span>Usuários</span></a>
    </li>
    <li class="nav-item @if ($page_active == 'cliente.dashboard') active @endif">
        <a class="nav-link" href="{{route('view.cliente.dashboard')}}">
            <i class="fa-solid fa-user"></i>
            <span>Clientes</span></a>
    </li>
    <li class="nav-item @if ($page_active == 'fornecedor.dashboard') active @endif">
        <a class="nav-link" href="{{route('view.fornecedor.dashboard')}}">
            <i class="fa-solid fa-user"></i>
            <span>Fornecedores</span></a>
    </li>
    <div class="sidebar-heading">
        Ordem de serviço
    </div>

    <li class="nav-item @if ($page_active == 'servico.dashboard') active @endif">
        <a class="nav-link" href="{{route('view.servico.dashboard')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Serviços</span></a>
    </li>
    <li class="nav-item @if ($page_active == 'taxa.dashboard') active @endif">
        <a class="nav-link" href="{{route('view.taxa.dashboard')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Taxa</span></a>
    </li>
    <li class="nav-item @if ($page_active == 'os.create' || $page_active == 'os.lista') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>OS</span>
        </a>
        <div id="collapseTwo" class="collapse @if ($page_active == 'os.create' || $page_active == 'os.lista') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Ordens de Serviço</h6>
                <a class="collapse-item @if ($page_active == 'os.create') active @endif" href="{{route('view.os.create')}}">Nova</a>
                <a class="collapse-item @if ($page_active == 'os.lista') active @endif" href="{{route('view.os.lista')}}">Lista</a>
            </div>
        </div>
    </li>
    <div class="sidebar-heading">
        Despezas
    </div>

    <li class="nav-item @if ($page_active == 'despeza.create' || $page_active == 'despeza.filter-mensal') active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDespeza"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Despezas</span>
        </a>
        <div id="collapseDespeza" class="collapse @if ($page_active == 'despeza.create' || $page_active == 'despeza.filter-mensal') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Despezas</h6>
                <a class="collapse-item @if ($page_active == 'despeza.create') active @endif" href="{{route('view.despeza.create')}}">Nova</a>
                <a class="collapse-item @if ($page_active == 'despeza.filter-mensal') active @endif" href="{{route('view.despeza.filter-mensal')}}">Mensal</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Relátorios / Gráficos
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{--  <li class="nav-item active">--}}
    {{-- <li class="nav-item"> --}}
        {{-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Relátorios</span>
        </a> --}}
        {{-- class="collapse show" coloque show para exibir de primeira --}}
        {{-- <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item active" href="blank.html">Blank Page</a>
            </div>
        </div> --}}
    {{-- </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Relátorios</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item active" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
