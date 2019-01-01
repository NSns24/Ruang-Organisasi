<?php

namespace App\Http\Middleware;

use Closure;
use App\Invitation;

class LoginMiddleware
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
        if(!auth()->check()) {
            return redirect('/');
        }

        $invitations = Invitation::where('user_to', auth()->id())->where('status', 0)->with('project')->with('userFrom')->get();

        $responds = Invitation::where('user_from', auth()->id())->where('status', '<>' , 0)->with('project')->with('userTo')->get();

        session()->flash('invitations', $invitations);
        session()->flash('responds', $responds);

        return $next($request);
    }
}
