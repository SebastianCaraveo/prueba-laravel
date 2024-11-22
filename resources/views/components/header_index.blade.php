<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Store Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">About Us</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @if (auth()->check() && auth()->user()->is_admin)
                        <a class="btn btn-outline-light me-3" href="{{ route('dashboard') }}">Dashboard</a>
                    @endif
                    <div>
                        @if (auth()->check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary">Cerrar sesión</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-outline-light mx-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Iniciar Sesión
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
