<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;//entrega información del usuario que esta logeado
use Closure;

class Admin
{
    //variable creada por mi
    protected $var;
    //constructor creado por mi
    public function __construct(Guard $var)
    {
        $this->var  = $var;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //validación: si el rol del usuario es distinto "admin", redireccionar al inicio
        if($this->var->user()->rol != 'Admin')
        {
            return redirect()->action('HomeController@index');
        }
        return $next($request);
    }
}
