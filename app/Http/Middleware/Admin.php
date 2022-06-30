<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Classes\Authentication;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Authentication::isAdmin()) {
            //cria uma msg vazia ou null, nenhuma msg de aviso é criada
                session(['msg' => [
                    'type' => 0,
                    'title' => 'Erro!',
                    'information' => 'Acesso restrito ao usuarios administradores!!'
                ]]);
            //
            return redirect()->back();
        }
        return $next($request);
    }
}
