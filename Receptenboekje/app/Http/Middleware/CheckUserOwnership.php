<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckUserOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $model = $request->route()->parameter('model'); // bv. 'recipe', 'post', enz.

        // Zorg dat het model een 'user_id' property heeft
        if (!$model || $model->user_id !== auth()->id()) {
            throw new NotFoundHttpException(); // Retourneer 404
        }

        return $next($request);
    }
}
