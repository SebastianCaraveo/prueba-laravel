@extends('dashboard')

@section('section-products')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <form action="{{route('products.store')}}" method="POST" class="w-100" enctype="multipart/form-data">
            @csrf
                <div class="mb-3 col-md-4">
                    <label for="InputProduct" class="form-label">¿Qué producto desea ingresar?</label>
                    <input type="text" class="form-control" id="InputProduct"
                        placeholder="Camiseta Manga Larga Calvin Klein" name="name_product" required>
                </div>

                <div class="mb-3 col-md-8">
                    <label for="InputDescription" class="form-label">Descripción del Producto</label>
                    <textarea type="text" class="form-control" id="InputDescription"  name="description_product"></textarea>
                </div>

                <div class="mb-3 col col-md-2">
                    <label for="InputPrice" class="form-label">Precio del Producto</label>
                    <input type="number" step="0.01" class="form-control" id="InpurPrice" name="price_product" required>
                </div>

                <div class="mb-3 col-md-3">
                    <label for="InputStock" class="form-label">Stock del Producto</label>
                    <input type="number" class="form-control" id="InputStock" name="stock_product" required>
                </div>

                <div class="mb-3 col-md-8">
                    <label for="category_id" class="label-form">Categoría del Producto</label>
                    <select id="category_id" class="form-control" name="category_id_product">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-8">
                    <label for="InputImage" class="form-label">Imágenes del Producto</label>
                    <input type="file" class="form-control" id="InputImage" name="images[]" multiple>
                </div>

                <button type="submit" class="btn btn-success col-md-8">Insertar Producto</button>
        </form>
    </div>

    <hr>

    <table class="table mt-3">
        <thead class="table-light">
            <tr>
                <th scope="row">id</th>
                <th scope="row">name</th>
                <th scope="row">description</th>
                <th scope="row">price</th>
                <th scope="row">stock</th>
                <th scope="row">is_active</th>
                <th scope="row">category_id</th>
                <th scope="row">Imagen</th>
                <th scope="row">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->is_active ? 'Si' : 'No'}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>
                        @if ($product->images->isNotEmpty())
                        @foreach ($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid" alt="Imagen del Producto">
                        @endforeach
                        @else
                        Sin Imagen
                        @endif
                    </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditProduct{{$product->id}}">
                                Modificar
                            </button>
                            <form action="{{route('products.destroy', $product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                    @include('components.modal_edit_product')
                    @include('components.modal_image')
                    @endforeach
                </tbody>
    </table>
@endsection
