<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileCompleteController extends Controller
{

    public function show() {
        $user = auth()->user();
        $missingFields = session()->get('missing_fields', []);

        return view('profile.complete-profile', compact('user', 'missingFields'));
    }

    // public function update(Request $request)
    // {
    //     $user = auth()->user();
    //     $fields = $user->requiredProfileFields();
    //     $missingFields = session()->get('missing_fields', []);
    //     $rules = [];

    //     foreach ($fields as $field => $config) {
    //         if (isset($missingFields[$field])) {
    //             $rules[$field] = $config['rules'];
    //         }
    //     }

    //     $validated = $request->validate($rules);
    //     $user->update($validated);

    //     $stillMissing = [];
    //     foreach ($fields as $field => $config) {
    //         if ($config['required'] && empty($user->fresh()->$field)) {
    //             $stillMissing[$field] = $config;
    //         }
    //     }

    //     if (!empty($stillMissing)) {
    //         session()->put('missing_fields', $stillMissing);
    //         return redirect()->route('profile.complete')
    //             ->with('error', 'Please fill in all required fields.');
    //     }

    //     session()->forget('missing_fields');
    //     return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    // }    
    public function update(Request $request) {

    // Run checks to ensure all required fields are filled:
    // User logs in → Middleware checks country is empty

    // Session stores missing_fields = ['country' => [...]]

    // User is redirected to /profile/complete

    // show() method loads the form with country field

    // User submits with "United States"

    // update() method validates, saves, clears session    

    
    
            $user = auth()->user();
            $fields = $user->requiredProfileFields();
            $missingFields = session()->get('missing_fields', []);
            $rules = [];

            // Build validation rules from required fields
            foreach ($fields as $field => $config) {
                if (isset($missingFields[$field])) {
                    $rules[$field] = $config['rules'];
                }
            }

            $validated = $request->validate($rules);
            $user->update($validated);

            // FINAL CHECK: Verify all fields are now filled
            $stillMissing = [];
            foreach ($fields as $field => $config) {
                if ($config['required'] && empty($user->fresh()->$field)) {
                    $stillMissing[$field] = $config;
                }
            }

            if (!empty($stillMissing)) {
                session()->put('missing_fields', $stillMissing);
                return redirect()->route('profile.complete')->with('error', 'Please fill in all required fields.');
            }

            // Clear the session
            session()->forget('missing_fields');

            return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }    
}
