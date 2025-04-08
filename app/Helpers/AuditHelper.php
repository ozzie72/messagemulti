<?php

namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class AuditHelper
{
    /**
     * Registra una acción en el log de auditoría
     *
     * @param string $operation Descripción de la operación
     * @param mixed $details Detalles adicionales (array, objeto o string)
     * @param string $type Tipo de log (info, warning, error, etc.)
     * @param string|null $ip Dirección IP (opcional)
     * @return Log|null
     */
    public static function log(
        string $operation,
        $details = null,
        string $type = 'info',
        string $ip = null
    ): ?Log {
        try {
            $ip = $ip ?? request()->ip();
            
            return Log::create([
                'operation' => $operation,
                'ip' => $ip,
                'user_id' => Auth::id(),
                'type' => $type,
                'details' => $details,
                'url' => request()->fullUrl(),
                'method' => request()->method()
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al registrar auditoría: ' . $e->getMessage());
            return null;
        }
    }
}