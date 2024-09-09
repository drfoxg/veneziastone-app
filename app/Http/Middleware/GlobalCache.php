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
    private $model;
    private $modelClass;
    private Request $request;

    public function handle(Request $request, Closure $next, string $modelClass = null): Response
    {
        $this->modelClass = $modelClass;
        $this->request = $request;

        if (isset($modelClass)) {
            $model = $this->createModel($modelClass);
            $this->model = $model;
        } else {
            return $next($request);
        }

        $command = $this->getLastName($request);

        $result = null;
        switch ($command) {
            case 'index':
                $result = $this->getCacheIndex();
                $request->merge(['model' => $result]);
                break;
            case 'show':
                $result = $this->getCacheShow();
                $request->merge(['modelItem' => $result]);
                break;
            default:
                return $next($request);
        }

        return $next($request);
    }

    private function getCacheIndex()
    {
        $result = null;

        $model = $this->model;
        $result = Cache::rememberForever("{$this->modelClass}:all", function() use($model) {
            return $model::all();
        });

        return $result;
    }

    private function getCacheShow()
    {
        $result = null;

        if (Cache::has("{$this->modelClass}:{$this->request->id}")) {
            $result = Cache::get("{$this->modelClass}:{$this->request->id}");
        }

        return $result;
    }


    private function createModel(string $modelClass)
    {
        $modelClass = "App\\Models\\{$modelClass}";
        return new $modelClass();
    }

    private function getLastName(Request $request)
    {
        return last(explode('.', $request->route()->getName()));
    }
}
