<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Classes\Authentication;

class Login
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
    if (!Authentication::check()) {
        //cria uma msg vazia ou null, nenhuma msg de aviso é criada
            session(['msg' => [
                'type' => 2,
                'title' => 'Atenção!',
                'information' => 'Realize o login para ter acesso ao sistema!'
            ]]);
        //
        return redirect()->route('login');
    }
    return $next($request);
}
}
