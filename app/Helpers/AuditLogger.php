<?php

namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogger
{
    /**
     * Registra una entrada de log de auditoría.
     *
     * @param string $operation Descripción de la operación (ej. 'Usuario creado', 'Campaña creada').
     * @param mixed $details Detalles opcionales relacionados con la operación (puede ser array, objeto o string). Se almacenará como JSON.
     * @param mixed $type Información de tipo opcional (puede ser array, objeto o string). Se almacenará como JSON.
     * @return void
     */
    public static function log(string $operation, $details = null, $type = null): void
    {
        try {
            // Obtener el ID del usuario autenticado si está disponible
            $userId = Auth::id();

            // Obtener detalles de la solicitud si está en contexto web
            // Usamos optional() para evitar errores si no hay solicitud (ej. en comandos Artisan)
            $request = Request::instance(); // Obtiene la instancia subyacente de Symfony Request

            $ip = $request->getClientIp(); // Método robusto para obtener la IP
            $method = $request->getMethod();
            $url = $request->fullUrl();

            // Crear la entrada en la base de datos
            Log::create([
                'user_id' => $userId,
                'operation' => $operation,
                'ip' => $ip, // Será la IP del cliente, o null si no hay solicitud (ej. consola)
                'method' => $method, // Será el método HTTP, o null si no hay solicitud
                'url' => $url, // Será la URL completa, o null si no hay solicitud
                'type' => $type, // Eloquent se encarga de convertir arrays/objetos a JSON
                'details' => $details, // Eloquent se encarga de convertir arrays/objetos a JSON
            ]);

        } catch (\Exception $e) {
            // Opcional: Loguear el error si falla la escritura del log de auditoría
            // Esto evita que una falla en el log de auditoría rompa la operación principal
            \Log::error('Error al escribir log de auditoría: ' . $e->getMessage(), [
                'operation' => $operation,
                'details' => $details,
                'type' => $type,
                 'user_id' => Auth::id(), // Intentar obtener el ID del usuario incluso si falló la solicitud
            ]);
            // se podría considerar reportar esta excepción a un sistema de monitoreo
        }
    }
}