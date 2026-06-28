<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class CheckInstructorStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (
            $user &&
            $user->role === 'instructor' &&
            $user->account_status === 'disabled'
        ) {
            auth()->logout();
            return redirect()
                ->route('login')
                ->with('error', 'Your instructor account has been disabled. Please contact the administrator.');
        }
        return $next($request);
    }
}
