<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Team $team
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return Inertia::render('Teams/Show', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team         $team
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
    }
}
