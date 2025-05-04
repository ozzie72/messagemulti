@extends('components.layouts.main')
@push('styles')
<style>
        .dataTables_wrapper .dataTables_length select {
            width : 60px;
        }
</style>
@endpush
@section('content')
 
   
    <section role="main" >
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-responsive">
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
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table responsive table-striped table-hover" width=100% id="clients-table">
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
    </section>
    @section('scripts')
    <script>
    
    $(document).ready(function() {
        // Inicializar DataTable
        var table = $('#clients-table').DataTable({
            language: {url: "{{asset('assets/js/es-MX.json')}}"},
            processing: true,
            serverSide: true,
            responsive: true,
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
@endsection

