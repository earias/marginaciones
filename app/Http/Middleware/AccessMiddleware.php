<?php

namespace App\Http\Middleware;

use Closure;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // foreach (auth()->user()->accesosRol() as $accesos) {
        //     if ($accesos->url == $request->route()->action['as']) {
        //         return $next($request);
        //     }
        // }

        // return redirect('403');

        $url = $request->path();
        $porciones_2 = explode("\/", $url);
        $porciones_1 = explode("/", $url);

        foreach (auth()->user()->accesosRol() as $accesos) {
            $url_per     = $accesos->url;
            $porciones_3 = explode("\/", $url_per);
            $porciones_4 = explode("/", $url_per);
            if ($porciones_3[0] == $porciones_2[0] || $porciones_4[0] == $porciones_1[0]) {
                return $next($request);
            }
        }

        return redirect('403');

    }
}
