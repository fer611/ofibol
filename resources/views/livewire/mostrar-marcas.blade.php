<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Marcas</h4>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn" style="background: #3B3F5C; color:white" data-toggle="modal"
                            data-target="#nuevaMarcaModal">
                            <li class="fa fa-plus"></li> Nueva Marca
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="marcas">
                                <thead style="background: #3B3F5C; color:white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $marca)
                                        <tr>
                                            <td>{{ $marca->id }}</td>
                                            <td>{{ $marca->nombre }}</td>
                                            <td class="d-flex align-items-center ">
                                                {{-- Editar --}}
                                                <a class="btn btn-warning btn-sm mr-1 mb-1 edit-button"
                                                    href="{{ route('marcas.edit', $marca->id) }}"><i
                                                        class="fas fa-pen"></i></a>

                                                <button type="button"
                                                    class="btn btn-outline-danger btn-sm delete-button"
                                                    wire:click="eliminarMarca({{ $marca->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>
        <div class="modal fade" id="nuevaMarcaModal" tabindex="-1" role="dialog"
            aria-labelledby="nuevaMarcaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevaMarcaModalLabel">Nueva Marca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Aca el formulario --}}
                        <livewire:crear-marca />
                        {{-- Modal para crear marcas --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .modal-md {
                max-width: 50%;
                /* Ajusta el tamaño medio deseado */
                width: auto;
            }
        </style>
    </div>
</div>
