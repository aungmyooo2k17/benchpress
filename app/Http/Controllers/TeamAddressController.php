<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\TeamAddressRequest;
use App\Http\Responses\TeamAddressResponse;
use App\Actions\Teams\UpdateTeamAddressInformation;

class TeamAddressController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\TeamAddressRequest           $request
     * @param \App\Models\Team                                $team
     * @param \App\Actions\Teams\UpdateTeamAddressInformation $updater
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TeamAddressRequest $request, Team $team, UpdateTeamAddressInformation $updater)
    {
        $updater->update($team, $request->validated());

        return TeamAddressResponse::dispatch($team->fresh());
    }
}
