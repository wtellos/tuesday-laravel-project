<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Policies\NinjaPolicy;

use App\Models\Vote;
use App\Models\Ninja;
use App\Models\Dojo;
use App\Models\User;

class NinjaController extends Controller

{
  use AuthorizesRequests;



  // Define the vote method to handle voting for a ninja
  public function vote(Request $request, Ninja $ninja) {
      // Validate
      $request->validate([
          'type' => 'required|in:up,down'
      ]);

      // Find existing vote
      $existingVote = Vote::where('user_id', auth()->id())
                          ->where('ninja_id', $ninja->id)
                          ->first();

      if ($existingVote) {
          if ($existingVote->type === $request->type) {
              $existingVote->delete();
          } else {
              $existingVote->update(['type' => $request->type]);
          }
      } else {
          Vote::create([
              'user_id' => auth()->id(),
              'ninja_id' => $ninja->id,
              'type' => $request->type
          ]);
      }

      // UPDATE CACHED COUNTS
      $ninja->update([
          'upvotes_count' => $ninja->upVotes()->count(),
          'downvotes_count' => $ninja->downVotes()->count(),
      ]);

      return redirect()->back()->with('success', 'Vote recorded!');
  }

    // Define the index method to display a list of ninjas
    public function index() {
      // route --> /ninjas/
      $ninjas = Ninja::with('dojo')->orderBy('created_at', 'desc')->paginate(10);

      return view('ninjas.index', ['ninjas' => $ninjas]);
    }

    // Define the show method to display a single ninja in a view
    public function show(Ninja $ninja) {
      // route --> /ninjas/{id}
      $ninja->load('dojo');

      return view('ninjas.show-ninja', ['ninja' => $ninja]);
    }

    // Display the form for creating a new ninja
      // It bother me for using "create" for this view because there's a "create" in Policy
    public function create() {
      // route --> /ninjas/create
      $dojos = Dojo::all();

      return view('ninjas.create-ninja', ['dojos' => $dojos]);
    }

    // Define the store method for creating a new ninja
    public function store(Request $request) {

      $this->authorize('createNinja', Ninja::class); // NinjaPolicy

      $validated = $request->validate([
        'name' => 'required|string|max:255',
        'skill' => 'required|integer|min:0|max:100',
        'bio' => 'required|string|min:20|max:1000',
        'dojo_id' => 'required|exists:dojos,id',
      ]);

      $validated['user_id'] = Auth::id(); // Assign the authenticated user's ID to the new ninja]

      Ninja::create($validated);

      return redirect()->route('ninjas.index')->with('success', 'Ninja created!');
    }

    
    // Define the destroy method to handle the deletion of a ninja
    public function destroy(Ninja $ninja) {
     
      $this->authorize('delete', $ninja); // NinjaPolicy 

      $ninja->delete();

      return redirect()->route('ninjas.index')->with('success', 'Ninja deleted!');
    }

    // edit() and update() for edit view and update requests
    // we won't be using these routes
}
