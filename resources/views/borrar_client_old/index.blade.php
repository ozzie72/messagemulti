@extends('components.layouts.main')

@section('title')
    Lista de Clientes
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}" type="text/css" rel="stylesheet" />
@endsection


@section('content')
    <div class="box box-solid bg-gray-light no-shadow">
        <div class="box-header with-border text-black">
            <h3 class="box-title text-navy">Lista de Clientes</h3>
            <div class="pull-right">
                <a href="{{ route('clients.create') }}" class="btn bg-blue-tt btn-sm" >
                    <i class="fa fa-plus-circle"></i>&nbsp;&nbsp; Crear Cliente
                </a>
            </div>
        </div>
        <div class="box-body">
            <table id="groupsTable" class="table table-bordered table-striped bg-white">
                <thead>
                <tr>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Dirección Servidor</th>
                    <th class="text-center">Puerto de Conexión</th>
                    <th class="text-center">Estatus</th>
                    <th class="text-center">Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->ip }}</td>
                        <td>{{ $client->port }}</td>
                        <td>{{ ($client->client_status == 'A')?'Activo':'Inactivo' }}</td>
                        <td class="text-center">
                            <a href="{{ route('clients.show', $client->id) }}" class="btn bg-blue-tt btn-sm">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function(){
            $('#groupsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [[ 0, "asc" ]],
                "info": false,
                "autoWidth": false
            });
        });
    </script>
@endsection
