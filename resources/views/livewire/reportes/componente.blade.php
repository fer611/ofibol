<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
           {{--  <div class="widget-heading">
                <h4 class="card-title text-center mb-0"><b>{{ $componenteNombre }}</b></h4>
            </div> --}}
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el usuario</h6>
                                <div class="form-group">
                                    <select wire:model='userId' class="form-control">
                                        <option value="0">Todos</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Elige el tipo de reporte</h6>
                                <div class="form-group">
                                    <select wire:model='reportType' class="form-control">
                                        <option value="0">Ventas de día</option>
                                        <option value="1">Ventas por fecha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha desde</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateFrom" class="form-control flatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha hasta</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateTo" class="form-control flatpickr"
                                        placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire:click="$refresh" class="btn btn-dark btn-block">
                                    Consultar
                                </button>

                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('report/pdf' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank">Generar PDF</a>
                                <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
                                    href="{{ url('report/excel' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank">Exportar a Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        {{-- TABLA --}}
                        <div class="table-responsive">
                            <table class="table table-bordered striped mt-1">
                                <thead class="text-white" style="background: #3B3F5C">
                                    <tr>
                                        <th class="table-th text-white text-center">FOLIO</th>
                                        <th class="table-th text-white text-center">TOTAL</th>
                                        <th class="table-th text-white text-center">ITEMS</th>
                                        <th class="table-th text-white text-center">ESTADO</th>
                                        <th class="table-th text-white text-center">USUARIO</th>
                                        <th class="table-th text-white text-center">FECHA</th>
                                        <th class="table-th text-white text-center" width="50px"></th>
                                </thead>
                                <tbody>

                                    @if (count($data) < 1)
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <h5>No hay resultados</h5>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($data as $d)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{ $d->id }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ number_format($d->total, 2) }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->items }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->estado }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $d->user->name }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>
                                                    {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}
                                                </h6>
                                            </td>
                                            <td class="text-center" width="50px">
                                                <h6>
                                                    <button wire:click.prevent="getDetails({{ $d->id }})"
                                                        class="btn btn-dark btn-sm">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                </h6>
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
    </div>
    @include('livewire.reportes.ventas-detalle')

    {{-- Flatpickr para el calendario --}}
    <link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.dark.css') }}">
    <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(document.getElementsByClassName('flatpickr'), {
                // Configuración de Flatpickr (opcional)
                enableTime: false,
                dateFormat: "d/m/Y", // Formato de fecha
                locale: {
                    firstDayOfWeek: 1, // Inicio de semana lunes
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado",
                        ],
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dic",
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre",
                        ],
                    },
                }
            });

            //eventos
            Livewire.on('show-modal', Msg => {
                $('#modalDetalles').modal('show');
            });
        });
    </script>
</div>
