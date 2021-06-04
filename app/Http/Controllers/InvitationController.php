<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Invitation;
use App\Contracts\Actions\InvitesMember;
use App\Http\Requests\InvitationRequest;
use App\Http\Responses\InvitationResponse;
use Illuminate\Auth\Access\AuthorizationException;

class InvitationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return Inertia::render('Invitations/Create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\InvitationRequest $request
     * @param \App\Models\Team                     $team
     * @param \App\Contracts\Actions\InvitesMember $inviter
     *
     * @return \Illuminate\Http\Response
     */
    public function store(InvitationRequest $request, Team $team, InvitesMember $inviter)
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
    public function update(InvitationRequest $request, Team $team, Invitation $invitation)
    {
        if (! $invitation->team->is($team)) {
            throw new AuthorizationException('Permission denied.');
        }

        $invitation->accept();

        return Inertia::render('Auth/Register', compact('invitation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Invitation $invitation
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        $this->authorize('destroy', $invitation);

        $invitation->cancel();

        return $this->response()->back(303);
    }
}
