@extends('dashboard')

@section('section_categories')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif


    <div class="d-flex justify-content-between mb-4">
        <form action="{{ route('store_category') }}" method="post" class="w-100">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="InputCategory" class="form-label">¿Qué categoria desea ingresar?</label>
                    <input type="text" class="form-control" id="InputCategory" placeholder="Camiseta"
                        name="name_category">
                </div>
                <div class="mb-3 col-md-8">
                    <label for="InputDescription" class="form-label">Descripción de la categoria</label>
                    <textarea class="form-control" id="InputDescription" rows="3" name="description_category"></textarea>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success">Insertar categoria</button>
            </div>
        </form>
    </div>

    <table class="table mt-3">
        <thead class="table-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Categoria</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Activo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->is_active ? 'Si' : 'No' }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#ModalEditCategory{{ $category->id }}">
                            Modificar
                        </button>
                        <form action="{{route('delete_category', $category->id)}}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>

                @include('components.modal_edit_category')
            @endforeach
        </tbody>
    </table>

@endsection
