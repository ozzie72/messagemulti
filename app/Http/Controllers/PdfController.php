<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;

class PdfController extends Controller
{
    public function index () {

        // Obtener usuarios con sus relaciones
        $users = User::with(['client', 'roles'])
            ->orderBy('name')
            ->get();

        // Configuración de columnas personalizadas
        $columns = [
            'id' => [
            'title' => 'ID',
            'style' => 'width: 50px;'
            ],
            'initials' => [
            'title' => 'Iniciales',
            'format' => 'initials'
            ],
            'name' => [
            'title' => 'Nombre',
            'cellStyle' => 'font-weight: bold;'
            ],
            'last_name' => [
            'title' => 'Apellido'
            ],
            'email' => [
            'title' => 'Correo Electrónico'
            ],
            'phone' => [
            'title' => 'Teléfono'
            ],
            'client' => [
            'title' => 'Cliente',
            'format' => 'client'
            ],
            'roles' => [
            'title' => 'Roles',
            'format' => 'roles'
            ],
            'user_status' => [
            'title' => 'Estado',
            'format' => 'status',
            'render' => function($user) {
                $status = $user->user_status ? 'Activo' : 'Inactivo';
                $class = $user->user_status ? 'badge bg-success' : 'badge bg-danger';
                return "<span class='{$class}'>{$status}</span>";
            }
            ],
            'created_at' => [
            'title' => 'Fecha Registro',
            'format' => 'date'
            ]
        ];

        $pdf = Pdf::loadView('utils.pdf.pdf', [
            'title' => 'Reporte Completo de Usuarios',
            'subtitle' => 'Listado detallado de todos los usuarios del sistema',
            'date' => now()->format('d/m/Y H:i'),
            'users' => $users,
            'columns' => $columns,
            'summary' => 'Este reporte incluye todos los usuarios registrados en el sistema con sus datos principales y estado actual.',
            'notes' => 'Los usuarios inactivos no pueden acceder al sistema. Verifique los roles asignados a cada usuario.',
            'footer' => 'Confidencial - Uso interno exclusivo'
            ])->setPaper('letter', 'landscape'); // 'portrait' para vertical (predeterminado);

        return $pdf->stream('reporte-usuarios-completo.pdf');
        }        


}
