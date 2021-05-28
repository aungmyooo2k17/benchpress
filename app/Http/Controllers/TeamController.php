<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Http\Requests\TeamRequest;
use App\Http\Responses\TeamResponse;
use App\Actions\Team\UpdateTeamInformation;

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
    public function update(TeamRequest $request, Team $team, UpdateTeamInformation $updater)
    {
        $updater->update($team, $request->validated());

        return TeamResponse::dispatch($team->fresh());
    }
}
