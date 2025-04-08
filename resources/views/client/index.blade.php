@extends('components.layouts.main')

@section('title')
    Clients
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clients') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-striped table-hover" id="clients-table">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th >Name</th>
                                        <th >Ip</th>
                                        <th >Port</th>
                                        <th >Server User</th>
                                        <th >Status</th>
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
        var table = $('#clients-table').DataTable({
            language: {url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"},
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('clients.index') }}",
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'ip', name: 'ip' },
                { data: 'port', name: 'port' },

                { data: 'server_user', name: 'server_user' },
                { data: 'status', name: 'status' },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    className: 'text-center' 
                }
            ]
        });

        // Eliminar cliente con mejor manejo
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var countryId = $(this).data('id');
            var url = "{{ route('clients.destroy', ':id') }}";
            url = url.replace(':id', countryId);
            
            if (confirm('¿Estás seguro de eliminar este cliente?')) {
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
                        var errorMessage = xhr.responseJSON?.error || 'Error al eliminar el cliente';
                        toastr.error(errorMessage);
                    }
                });
            }
        });
    });
</script>

@endsection
