<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        
        // Skip if user is not logged in
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();
        $missingFields = [];

        // Check each required field
        foreach ($user->requiredProfileFields() as $field => $config) {
            if ($config['required'] && empty($user->$field)) {
                $missingFields[$field] = $config;
            }
        }

        // If fields are missing, store them in session and redirect
        if (!empty($missingFields)) {
            session()->put('missing_fields', $missingFields); // Found in the ProfileCompleteController
            return redirect()->route('profile.complete')
                ->with('error', 'Please complete your profile before proceeding.');
        }

        return $next($request);
    }
}