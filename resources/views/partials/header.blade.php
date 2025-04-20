
<!-- start: header -->


<header class="header">
    <div class="logo-container">
        <a href="{{route('dashboard')}}" class="logo">
           
            <picture>
                <source srcset="{{ asset('assets/img/message_logo_blanco.png') }}" media="(prefers-color-scheme: dark)">
                <img src="{{ asset('assets/img/message_logo_client.png') }}" width=200px alt="logo_message">
            </picture>
      
        </a>

        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>

    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <span class="separator"></span>

        <ul class="notifications">
            
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-bell"></i>
                    <span class="badge">3</span>
                </a>

                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">3</span>
                        Notificaciones
                    </div>

                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="fas fa-thumbs-down bg-danger text-light"></i>
                                    </div>
                                    <span class="title">Nueva campaña enviada!</span>
                                    <span class="message">Reciente</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-lock bg-warning text-light"></i>
                                    </div>
                                    <span class="title">Creada nueva campaña</span>
                                    <span class="message">Hace 15 minutos</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="fas fa-signal bg-success text-light"></i>
                                    </div>
                                    <span class="title">Login exitoso</span>
                                    <span class="message">10/04/2025</span>
                                </a>
                            </li>
                        </ul>

                        <hr />

                        <div class="text-end">
                            <a href="#" class="view-more">Ver todas</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{ asset('assets/img/!logged-user.jpg') }}" alt="Joseph Doe" class="rounded-circle" data-lock-picture="{{ asset('assets/img/!logged-user.jpg') }}" />
                </figure>
                @auth
                    <div class="profile-info" data-lock-name="{{\Auth::user()->name}}" data-lock-email="{{\Auth::user()->email}}">
                        <span class="name">{{\Auth::user()->name}}</span>
                      
                    </div>
                @endauth

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('settings.profile')}}"><i class="bx bx-user-circle"></i> Mi perfil</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('settings.password')}}"><i class="bx bx-low-vision"></i> Cambiar contraseña</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('users.logout')}}"><i class="bx bx-power-off"></i> Salir del sistema</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>

<!-- end: header -->