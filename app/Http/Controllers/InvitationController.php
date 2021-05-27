<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Actions\Team\InviteStaffMember;
use App\Http\Requests\InvitationRequest;
use App\Http\Responses\InvitationResponse;

class InvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InvitationRequest $request, Team $team, InviteStaffMember $inviter)
    {
        $invitation = $inviter->invite($team, $request->validated());

        return InvitationResponse::dispatch($invitation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invitation   $invitation
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team, Invitation $invitation)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Invitation $invitation
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, Invitation $invitation)
    {
        if ($team->is($invitation->team)) {
            $invitation->cancel();
        }

        return $this->response()->back(303);
    }
}
