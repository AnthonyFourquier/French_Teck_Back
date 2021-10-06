<?php
namespace App\Http\Middleware;
use Closure;
class Admin
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
        $user = $request->user();
        if ($user && $user->role === 'admin') {
            return $next($request);

        return response()->json(['success' => true, $this->successStatus]);
        }
        else {

            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
