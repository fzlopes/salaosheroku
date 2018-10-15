<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search " action="javascript:;" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" id="busca_cliente" name="busca_cliente" placeholder="Buscar cliente..." autocomplete="off" spellcheck="false" dir="auto">
                        <input type="hidden" id="selected_client" value="">
                        <input type="hidden" id="url_client" value="{{ url('/usuarios/') }}">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit" id="btn_busca_cliente">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
            </li>

            <li class="nav-item {{ Route::getCurrentRoute()->uri() == 'dashboard' ? ' start active open' : '' }}">
                <a href="{{ route('profile.dashboard') }}" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    @if (Route::getCurrentRoute()->uri() == 'dashboard')
                        <span class="selected"></span>
                    @endif
                </a>
            </li>

            <li class="nav-item {{ Route::getCurrentRoute()->uri() == 'profile' ? ' start active open' : '' }}">
                <a href="{{ route('profile.profile') }}" class="nav-link">
                    <i class="icon-user"></i>
                    <span class="title">Meu perfil</span>
                    @if (Route::getCurrentRoute()->uri() == 'profile')
                        <span class="selected"></span>
                    @endif
                </a>
            </li>

            <li class="nav-item  {{ strstr(Route::getCurrentRoute()->getName(), '.', true) == 'clientes' || Request::is('clientes/create') ? ' start active open' : '' }}">
                <a href="{{ route('clientes.index') }}" class="nav-link ">
                    <i class="icon-rocket"></i>
                    <span class="title">Clientes</span>
                </a>
            </li>

            <li class="nav-item  {{ strstr(Route::getCurrentRoute()->getName(), '.', true) == 'servicos' || Request::is('servicos/create') ? ' start active open' : '' }}">
                <a href="{{ route('servicos.index') }}" class="nav-link ">
                    <i class="icon-rocket"></i>
                    <span class="title">Serviços</span>
                </a>
            </li>

            <li class="nav-item  {{ strstr(Route::getCurrentRoute()->getName(), '.', true) == 'agendas' || Request::is('agendas/create') ? ' start active open' : '' }}">
                <a href="{{ route('agendas.index') }}" class="nav-link ">
                    <i class="icon-rocket"></i>
                    <span class="title">Agenda</span>
                </a>
            </li>
 
        </ul>
    </div>
</div>
