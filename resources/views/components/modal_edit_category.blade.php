<div class="modal fade" id="ModalEditCategory{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Categoria "{{ $category->name }}"</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('update_category', $category->id)}}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="InputCategory" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="InputCategory" aria-describedby="CategoryHelp" value="{{$category->name}}" name="name_category">
                        </div>
                        <div class="mb-3">
                            <label for="InputDescriptionCategory" class="form-label">Descripción</label>
                            <textarea type="text" class="form-control" id="InputDescriptionCategory" aria-describedby="DescriptionHelp" name="description_category">{{$category->description}}</textarea>
                        </div>
                        <div class="mb-3 mx-3 form-check">
                            <input type="checkbox" class="form-check-input" id="isActive{{$category->id}}"
                            name="is_active" {{$category->is_active ? 'checked': ''}}>
                            <label class="form-check-label" for="isActive{{$category->id}}">Activo</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
