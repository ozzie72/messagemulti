<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
           Menu navegación
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li class="{{Request::is('dashboard*')?'nav-active':''}}">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>                        
                    </li>
                    <li class="{{Request::is('clients*')?'nav-active':''}}">
                        <a class="nav-link " href="{{route('clients.index')}}">
                            <i class="bx bx-user-check" aria-hidden="true"></i>
                            <span>Clientes</span>
                        </a>                        
                    </li>
                    <li class="{{Request::is('users*')?'nav-active':''}}">
                        <a class="nav-link " href="{{route('users.index')}}">
                            <i class="bx bx-user-circle" aria-hidden="true"></i>
                            <span>Usuarios</span>
                        </a>                        
                    </li>
                    <li class="nav-parent {{Request::is('settings/profile*')?'nav-expanded':''}}
                                          {{Request::is('settings/password*')?'nav-expanded':''}}
                                          {{Request::is('settings/appearance*')?'nav-expanded':''}}">
                        <a class="nav-link" href="#">
                            <i class="bx bx-cog" aria-hidden="true"></i>
                            <span>Configuración</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{Request::is('settings/profile*')?'nav-active':''}}">
                                <a class="nav-link " href="{{route('settings.profile')}}">
                                    <i class="bx bx-user-pin" aria-hidden="true"></i>
                                    <span>Perfil</span>
                                    
                                </a>
                            </li>
                            <li class="{{Request::is('settings/password*')?'nav-active':''}}">
                                <a class="nav-link " href="{{route('settings.password')}}">
                                    <i class="bx bx-low-vision" aria-hidden="true"></i>
                                    <span>Cambiar contraseña</span>
                                </a>
                            </li>
                            <li class="{{Request::is('settings/appearance*')?'nav-active':''}}">
                                <a class="nav-link " href="{{route('settings.appearance')}}">
                                    <i class="bx bx-credit-card-front" aria-hidden="true"></i>
                                    <span>Apariencia</span>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                </ul>
            </nav>

            <hr class="separator" />

           
        </div>

      

    </div>

</aside>

@section('script')
<script>
    // Maintain Scroll Position
    debugger
    if (typeof localStorage !== 'undefined') {
        if (localStorage.getItem('sidebar-left-position') !== null) {
            var initialPosition = localStorage.getItem('sidebar-left-position'),
                sidebarLeft = document.querySelector('#sidebar-left .nano-content');

            sidebarLeft.scrollTop = initialPosition;
        }
    }
</script>
@endsection
<!-- end: sidebar -->