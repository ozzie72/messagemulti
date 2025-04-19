@extends('components.layouts.main')

@section('title')
    Logs
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Logs') }}
                            </span>

                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="logs-table">
                                <thead class="thead">
                                    <tr>
                                        <th >Id</th>
                                        <th >User Id</th>
                                        <th >Operation</th>
                                        <th >Ip</th>
                                        <th >Method</th>
                                        <th >url</th>
                                        <th >Type</th>
                                        <th >Details</th>
                                        <th >Created_at</th>
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
        var table = $('#logs-table').DataTable({
            language: {url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"},
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('logs.index') }}",
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user_id', name: 'user->name' },
                { data: 'operation', name: 'operation' },
                { data: 'ip', name: 'ip' },
                { data: 'method', name: 'method' },
                { data: 'url', name: 'url' },
                { data: 'type', name: 'type' },
                { data: 'details', name: 'details' },
                { data: 'created_at', name: 'created_at' }
            ]
        });

    });
</script>

@endsection
