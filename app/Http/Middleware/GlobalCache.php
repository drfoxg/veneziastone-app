<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class GlobalCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $modelClass = null): Response
    {
        if (isset($modelClass)) {
            $modelClass = 'App\\Models\\'. $modelClass;
            $model = new \ReflectionClass($modelClass);
            $inst = $model->newInstance();

            $result  = Cache::rememberForever($modelClass . ':all', function() use($inst) {
                return $inst::all();
            });

            app()->instance($modelClass, $result);

        }

        return $next($request);
    }
}
