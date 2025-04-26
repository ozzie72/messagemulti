<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Reporte de Usuarios' }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            max-height: 80px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background-color: {{ $tableHeaderColor ?? '#4e73df' }};
            color: {{ $tableHeaderTextColor ?? '#ffffff' }};
            font-weight: bold;
            padding: 8px;
            text-align: left;
            border: 1px solid #dee2e6;
        }
        table td {
            padding: 8px;
            border: 1px solid #dee2e6;
        }
        table tr:nth-child(even) {
            background-color: {{ $tableEvenRowColor ?? '#f2f6fc' }};
        }
        .status-active {
            color: #28a745;
            font-weight: bold;
        }
        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #666;
        }
        .signature-area {
            margin-top: 50px;
            border-top: 1px dashed #333;
            padding-top: 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
        .badge {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    @if(isset($logo) && $logo)
        <div class="text-center">
            <img src="{{ $logo }}" class="logo" alt="Logo">
        </div>
    @endif

    <div class="header">
        <div class="title">{{ $title ?? 'Reporte de Usuarios' }}</div>
        @if(isset($subtitle) && $subtitle)
            <div class="subtitle">{{ $subtitle }}</div>
        @endif
        @if(isset($date) && $date)
            <div class="date mb-20">Generado el: {{ $date }}</div>
        @endif
    </div>

    @if(isset($summary) && $summary)
        <div class="summary mb-20">
            {!! $summary !!}
        </div>
    @endif

    @if(isset($users) && $users->count() > 0)
        <table>
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <th style="{{ $column['style'] ?? '' }}">{{ $column['title'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        @foreach($columns as $columnKey => $column)
                            <td style="{{ $column['cellStyle'] ?? '' }}">
                                @if(isset($column['format']) && $column['format'] === 'date')
                                    {{ $user->{$columnKey} ? \Carbon\Carbon::parse($user->{$columnKey})->format('d/m/Y H:i') : 'N/A' }}
                                @elseif(isset($column['format']) && $column['format'] === 'status')
                                    <span class="status-{{ $user->{$columnKey} ? 'active' : 'inactive' }}">
                                        {{ $user->{$columnKey} ? 'Activo' : 'Inactivo' }}
                                    </span>
                                @elseif(isset($column['format']) && $column['format'] === 'roles')
                                    {{ $user->getRoleNames()->implode(', ') }}
                                @elseif(isset($column['format']) && $column['format'] === 'client')
                                    {{ $user->client ? $user->client->name : 'N/A' }}
                                @elseif(isset($column['format']) && $column['format'] === 'initials')
                                    {{ $user->initials() }}
                                @elseif(isset($column['render']) && is_callable($column['render']))
                                    {!! $column['render']($user) !!}
                                @else
                                    {{ $user->{$columnKey} ?? '' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="text-center mb-20">
            Mostrando {{ $users->count() }} usuario(s) registrados
        </div>
    @else
        <div class="text-center mb-20">No hay usuarios para mostrar</div>
    @endif

    @if(isset($notes) && $notes)
        <div class="notes mb-20">
            <strong>Notas:</strong> {!! $notes !!}
        </div>
    @endif

    <div class="footer">
        {{ $footer ?? 'Documento generado el ' . now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>