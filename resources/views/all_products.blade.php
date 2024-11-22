@include('components.header_index')

<div class="container marketing">
    <h2 class="my-4">Todos los Productos</h2>
    <div class="row justify-content-around">
        @foreach ($allProducts as $product)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $product->images->first()->image_path ?? 'default.jpg') }}" class="card-img-top" alt="Imagen del Producto">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">Precio: ${{ $product->price }}</p>
                    <a href="#" class="btn btn-primary">Ver Producto</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
