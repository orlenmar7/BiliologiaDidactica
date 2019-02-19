        <aside class="sidebar" data-trigger="scrollbar">
            <!-- Sidebar Profile Start -->
            <div class="sidebar--profile">
                <div class="profile--img">
                    <a href="{{ route('admin.account.profile') }}">
                        <img src="{{ asset(Auth::user()->photo_url) }}" alt="" class="rounded-circle">
                    </a>
                </div>

                <div class="profile--name">
                    <a href="{{ route('admin.account.profile') }}" class="btn-link">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                </div>

                <div class="profile--nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="{{ route('admin.account.profile') }}" class="nav-link" title="Perfil de Usuario">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link" title="Cerrar Sesión">
                                <i class="fa fa-power-off"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Sidebar Profile End -->

            <!-- Sidebar Navigation Start -->
            <div class="sidebar--nav">
                <ul>
                    <li>
                        <ul>
                            <li>
                                <a href="{{ route('admin.index') }}">
                                    <i class="fa fa-home"></i>
                                    <span>Tablero</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-globe"></i>
                                    <span>Ver Página</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="fa fa-users"></i>
                                    <span>Usuarios</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.index') }}">
                                    <i class="fa fa-tags"></i>
                                    <span>Categorias</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.histories.index') }}">
                                    <i class="fa fa-book"></i>
                                    <span>Historias bíblicas</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ route('admin.statistics.index') }}">
                                    <i class="fa fa-chart-bar"></i>
                                    <span>Estadísticas</span>
                                </a>
                            </li> -->
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- Sidebar Navigation End -->

            <!-- Sidebar Widgets Start -->
            <!-- <div class="sidebar--widgets">
                <div class="widget">
                    <h3 class="h6 widget--title" style="color: #fff;">Information Summary</h3>

                    Summary Widget Start
                    <div class="summary--widget">
                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#2bb3c0">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                            <p class="summary--title">Daily Traffic</p>
                            <p class="summary--stats">307.512</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7,5,4,9,7,5,4</p>

                            <p class="summary--title">Average Usage</p>
                            <p class="summary--stats">2,371,527</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#cccccc">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                            <p class="summary--title">Disk Usage</p>
                            <p class="summary--stats">37.5%</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,3,7,7,9,11,9,7,9,11,9,7,5,4,9,7,5,4</p>

                            <p class="summary--title">CPU Usage</p>
                            <p class="summary--stats">37.05-32</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#ff4040">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                            <p class="summary--title">Memory Usage</p>
                            <p class="summary--stats">37.05%</p>
                        </div>
                    </div>
                    Summary Widget End
                </div>
            </div> -->
            <!-- Sidebar Widgets End -->
        </aside>
