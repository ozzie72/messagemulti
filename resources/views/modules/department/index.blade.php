@extends('components.layouts.main')

@section('title')
    {{ __('Departments') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Departments') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="departments-table">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th >{{ __('Divition') }}</th>
                                        <th >{{ __('Name') }}</th>
                                        <th >{{ __('Description') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
    $(document).ready(function() {
        // Inicializar DataTable
        var table = $('#departments-table').DataTable({
            language: {url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"},
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('departments.index') }}",
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'divition.name', name: 'divition.name' },
                { data: 'name', name: 'name' },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    className: 'text-center' 
                }
            ]
        });

        // Eliminar país con mejor manejo
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var countryId = $(this).data('id');
            var url = "{{ route('departments.destroy', ':id') }}";
            url = url.replace(':id', countryId);
            
            if (confirm('¿Estás seguro de eliminar este departamento?')) {
                $.ajax({
                    url: url,
                    type: 'POST', // Usamos POST para compatibilidad
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE' // Esto simula un DELETE
                    },
                    success: function(response) {
                        // Recargar la tabla manteniendo la paginación
                        table.ajax.reload(null, false);
                        
                        // Mostrar notificación
                        toastr.success(response.success);
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON?.error || 'Error al eliminar el país';
                        toastr.error(errorMessage);
                    }
                });
            }
        });
    });
</script>

@endsection
