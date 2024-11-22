<div class="modal fade" id="ModalEditProduct{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nombre del producto -->
                    <div class="mb-3">
                        <label for="InputProduct" class="form-label">¿Qué producto desea ingresar?</label>
                        <input type="text" class="form-control" id="InputProduct" name="name_product"
                            placeholder="Camiseta Manga Larga Calvin Klein" value="{{ $product->name }}">
                    </div>

                    <!-- Descripción del producto -->
                    <div class="mb-3">
                        <label for="InputDescription" class="form-label">Descripción del Producto</label>
                        <textarea class="form-control" id="InputDescription" name="description_product">{{ $product->description }}</textarea>
                    </div>

                    <!-- Precio del producto -->
                    <div class="mb-3">
                        <label for="InputPrice" class="form-label">Precio del Producto</label>
                        <input type="number" step="0.01" class="form-control" id="InputPrice" name="price_product"
                            value="{{ $product->price }}">
                    </div>

                    <!-- Stock del producto -->
                    <div class="mb-3">
                        <label for="InputStock" class="form-label">Stock del Producto</label>
                        <input type="number" class="form-control" id="InputStock" name="stock_product"
                            value="{{ $product->stock }}">
                    </div>

                    <!-- Categoría del producto -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoría del Producto</label>
                        <select id="category_id" class="form-control" name="category_id_product">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Imágenes del producto -->
                    <div class="mb-3 col-md-12">
                        <label for="InputImage{{ $product->id }}" class="form-label">Imágenes del Producto</label>
                        <input type="file" class="form-control" id="InputImage{{ $product->id }}" name="image[]"
                            multiple>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </form>

                <hr>

                <!-- Imágenes existentes -->
                <div class="mb-3">
                    <label class="form-label">Imágenes del Producto</label>
                    <div class="row">
                        @foreach ($product->images as $image)
                            <div class="col-md-3 position-relative">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Imagen del Producto"
                                    class="img-thumbnail" width="100%">
                                <form
                                    action="{{ route('products.images.delete', ['product' => $product->id, 'image' => $image->id]) }}"
                                    method="POST" class="position-absolute" style="top: 5px; right: 5px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta imagen?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path
                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
