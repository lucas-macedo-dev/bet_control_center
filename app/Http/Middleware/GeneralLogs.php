<?php

namespace App\Http\Middleware;

use App\Models\GeneralLog as GeneralLogModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class GeneralLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uuid = Str::uuid();
        $request->merge(['request_uuid' => $uuid]);
        $requestBody = $request->all();

        $keysToRemove = [
            'password',
            'password_confirmation',
            'token',
            'api_token',
            'api_key',
            'refresh_token',
            'client_secret',
            'client_id',
            '_token'
        ];

        GeneralLogModel::create([
            'uuid' => $uuid,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'request_body' => json_encode(array_diff_key($requestBody, array_flip($keysToRemove))),
            'status' => 'P',
            'http_status' => null,
        ]);
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $responseData = json_decode($response->getContent(), true);
            $responseData = $this->hideSensitiveData($responseData, $keysToRemove);
        } else {
            $responseData = $response->getContent();
        }

        GeneralLogModel::where('uuid', $uuid)->update([
            'response_body' => json_encode($responseData),
            'status' => $response->isSuccessful() ? 'S' : 'F',
            'http_status' => $response->getStatusCode(),
        ]);

        $response->headers->set('Request-UUID', $uuid);

        return $response;
    }

    protected function hideSensitiveData(array $data, array $keysToRemove): array
    {
        return array_diff_key($data, array_flip($keysToRemove));
    }
}
