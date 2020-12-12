<?php

namespace App\Http\Middleware;

use Closure;
use Carbon;
use App\Models\User\UserIp;

class CheckAlias
{
    /**
     * Redirects users without an alias to the dA account linking page,
     * and banned users to the ban page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null($request->user()->alias)) {
            return redirect('/link');
        }
        if($request->user()->is_banned) {
            return redirect('/banned');
        }

        return $next($request);
    }
}
