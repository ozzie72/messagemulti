<?php

namespace App\Http\Middleware;

use App\Helpers\AuditHelper;
use Closure;
use Illuminate\Http\Request;

class AuditRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Excluir rutas específicas (opcional)
        if ($this->shouldExcludeRoute($request)) {
            return $next($request);
        }

        $response = $next($request);

        // Registrar después de la respuesta para tener acceso a los datos
        $this->logRequest($request, $response);

        return $response;
    }

    protected function shouldExcludeRoute(Request $request): bool
    {
        $excluded = [
            'horizon*',
            'telescope*',
            'livewire*',
            '_debugbar*'
        ];
        
        return $request->is($excluded);
    }

    protected function logRequest(Request $request, $response)
    {
        $method = $request->method();
        $status = $response->getStatusCode();
        
        // Solo registrar métodos importantes
        if (!in_array($method, ['GET', 'OPTIONS', 'HEAD'])) {
            $operation = "{$method} {$request->path()}";
            $details = [
                'status' => $status,
                'input' => $request->except(['password', '_token']),
                'response' => $status >= 400 ? $this->getResponseData($response) : null
            ];
            
            AuditHelper::log($operation, $details, $this->getLogType($status));
        }
    }

    protected function getLogType(int $status): string
    {
        if ($status >= 500) return 'error';
        if ($status >= 400) return 'warning';
        return 'info';
    }

    protected function getResponseData($response)
    {
        try {
            return json_decode($response->getContent(), true);
        } catch (\Exception $e) {
            return null;
        }
    }
}