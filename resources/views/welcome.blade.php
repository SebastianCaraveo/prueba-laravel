<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagina Web</title>

    <link href="/styles/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    @include('components.header_index')

    <main>
        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h1>
                            <p class="opacity-75">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum sed
                                dolores sunt numquam temporibus ex veniam voluptatum itaque voluptas culpa natus minus
                                tempore eligendi, laborum, illo sequi? Accusantium, labore fuga!</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Registrate ya</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Other</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed ipsum perferendis soluta.
                                Hic quibusdam dolore fugit obcaecati repellendus provident animi accusantium omnis
                                beatae aut repudiandae rem, ipsam culpa reprehenderit illum?</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Registrate</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>One More</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi, provident consectetur aut
                                corporis corrupti autem culpa, quae quia perspiciatis, consequuntur illo amet vero at
                                nulla optio reiciendis veritatis voluptatibus quasi!</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Registrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container marketing">
            <div class="row justify-content-around">
                @foreach ($products as $product)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : 'ruta/a/imagen_por_defecto.jpg' }}"
                            class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#productModal{{ $product->id }}">
                                Ver más
                            </button>
                        </div>
                    </div>

                    {{-- Modal con especificaciones del producto --}}
                    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $product->id }}">{{ $product->name }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div id="carouselExample" class="carousel slide">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    @foreach ($product->images as $image)
                                                        <div class="col-md-4 mb-3">
                                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                                class="img-fluid img-thumbnail"
                                                                alt="{{ $product->name }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExample" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExample" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                    </div>
                                    {{-- Detalles del producto --}}
                                    <p>{{ $product->description }}</p>
                                    <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <a href="#" class="btn btn-primary">Comprar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                            class="text-body-secondary">It’ll blow your mind.</span></h2>
                    <p class="lead">Some great placeholder content for the first featurette here. Imagine some
                        exciting
                        prose here.</p>
                </div>
                <div class="col-md-5">
                    <img src="URL_DE_TU_IMAGEN" alt="Descripción de la imagen"
                        class="featurette-image img-fluid mx-auto" width="500" height="500">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                            class="text-body-secondary">It’ll blow your mind.</span></h2>
                    <p class="lead">Some great placeholder content for the first featurette here. Imagine some
                        exciting
                        prose here.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="URL_DE_TU_IMAGEN" alt="Descripción de la imagen"
                        class="featurette-image img-fluid mx-auto" width="500" height="500">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                            class="text-body-secondary">It’ll blow your mind.</span></h2>
                    <p class="lead">Some great placeholder content for the first featurette here. Imagine some
                        exciting
                        prose here.</p>
                </div>
                <div class="col-md-5">
                    <img src="URL_DE_TU_IMAGEN" alt="Descripción de la imagen"
                        class="featurette-image img-fluid mx-auto" width="500" height="500">
                </div>
            </div>

            <hr class="featurette-divider">
        </div>

        <footer class="container">
            <p>&copy; 2024 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
            </p>
        </footer>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">¡Bienvenido!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Pills navs -->
                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login"
                                role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register"
                                role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <!-- Pills content -->
                    <div class="tab-content">
                        <!-- Login Form -->
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                            aria-labelledby="tab-login">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="loginEmail"
                                        placeholder="name@example.com" name="email" required>
                                    <label for="loginEmail">Correo Electrónico</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="loginPassword"
                                        placeholder="Password" name="password" required>
                                    <label for="loginPassword">Contraseña</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                            </form>
                        </div>
                        <!-- Register Form -->
                        <div class="tab-pane fade" id="pills-register" role="tabpanel"
                            aria-labelledby="tab-register">
                            <form id="registerForm" action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="registerName" placeholder="Name"
                                        name="name" required>
                                    <label for="registerName">Nombre</label>
                                    <small class="text-danger" id="registerNameError"></small>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="registerEmail"
                                        placeholder="name@example.com" name="email" required>
                                    <label for="registerEmail">Correo Electrónico</label>
                                    <small class="text-danger" id="registerEmailError"></small>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="registerPassword"
                                        placeholder="Password" name="password" required>
                                    <label for="registerPassword">Contraseña</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="registerPassword"
                                        placeholder="Password" name="password_confirmation" required>
                                    <label for="registerPassword">Confirmar Contraseña</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
