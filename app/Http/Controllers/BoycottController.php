<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Boycott;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBoycottRequest;
use App\Http\Requests\UpdateBoycottRequest;

class BoycottController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoycottRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Boycott $boycott)
    {
         // Eager load necessary relations if not route-model bound with them
        $boycott->load('brand', 'users'); // Load users if you need to list them (careful with large numbers)
        $boycott->loadCount('users'); // Ensure user count is loaded

        $isParticipating = false;
        if (Auth::check()) {
            // Check if the currently logged-in user is participating in this boycott
            $isParticipating = Auth::user()->boycotts()->where('boycott_id', $boycott->id)->exists();
        }


        return view('boycott.show', compact('boycott', 'isParticipating'));
    }

    /**
     * Allow the logged-in user to participate in a boycott.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Boycott $boycott
     * @return \Illuminate\Http\RedirectResponse
     */
    public function participate(Request $request, Boycott $boycott)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Attach the user to the boycott (if not already attached)
        // attach() handles duplicates, but syncWithoutDetaching() is safer
        // if the action might be triggered multiple times quickly.
        $user->boycotts()->syncWithoutDetaching($boycott->id);
        // Log the action (optional)
        Log::create([
            'user_id' => $user->id,
            'boycott_id' => $boycott->id,
            'action' => $user->member_id.' '.$boycott->brand->name.' boykotuna katıldı.',
        ]);
        // Optionally, you can also log this action in a separate logs table

        return redirect()->route('boycott.show', $boycott->slug)->with('status', 'Boykota katıldınız!');
    }

    /**
     * Allow the logged-in user to leave a boycott.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Boycott $boycott
     * @return \Illuminate\Http\RedirectResponse
     */
    public function leave(Request $request, Boycott $boycott)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Detach the user from the boycott
        $user->boycotts()->detach($boycott->id);

        Log::create([
            'user_id' => $user->id,
            'boycott_id' => $boycott->id,
            'action' => $user->member_id.' '.$boycott->brand->name.' boykotundan ayrıldı.',
        ]);

        return redirect()->route('boycott.show', $boycott->slug)->with('status', 'Boykottan ayrıldınız.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boycott $boycott)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoycottRequest $request, Boycott $boycott)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boycott $boycott)
    {
        //
    }
}
