<?php

namespace App\Http\Middleware;

use Carbon\Carbon as CarbonCarbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UpdateUserLastActiveAt
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
        $user = $request->user();
        if($user)
        {
              $user->forcefill([
                'last_active_at' =>Carbon::now(),
              ])->save();
        }
        return $next($request);
    }
}
