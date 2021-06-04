<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Http\Requests\TeamRequest;
use App\Http\Responses\TeamResponse;
use App\Contracts\Actions\UpdatesTeamInformation;

class TeamController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Team $team
     *
     * @return \Inertia\Response
     */
    public function edit(Team $team)
    {
        $this->authorize('manage', $team);

        return Inertia::render('Teams/Edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\TeamRequest            $request
     * @param \App\Models\Team                          $team
     * @param \App\Actions\Teams\UpdatesTeamInformation $updater
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, Team $team, UpdatesTeamInformation $updater)
    {
        $updater->update($team, $request->validated());

        return TeamResponse::dispatch($team->fresh());
    }
}
