<?php

namespace App\Http\Middleware;

use App\Helpers\AuditHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        if ($this->shouldAudit($request)) {
            $this->logRequest($request, $response);
        }
        
        return $response;
    }

    protected function shouldAudit(Request $request): bool
    {
        return !$request->is([
            'up',
            'horizon*',
            'telescope*',
            'livewire*',
            '_debugbar*'
        ]);
    }

    protected function logRequest(Request $request, Response $response): void
    {
        $method = $request->method();
        $status = $response->getStatusCode();
        
        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            AuditHelper::log(
                operation: "{$method} {$request->path()}",
                details: [
                    'status' => $status,
                    'input' => $request->except(['password', '_token']),
                    'response' => $status >= 400 ? $this->getResponseData($response) : null
                ],
                type: $this->getLogType($status)
            );
        }
    }

    protected function getLogType(int $status): string
    {
        return match (true) {
            $status >= 500 => 'error',
            $status >= 400 => 'warning',
            default => 'info'
        };
    }

    protected function getResponseData(Response $response): ?array
    {
        try {
            return json_decode($response->getContent(), true) ?: null;
        } catch (\Exception) {
            return null;
        }
    }
}