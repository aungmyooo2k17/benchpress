<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Invitation;
use Cratespace\Preflight\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        return Inertia::render('Staff/Index', [
            'team' => $team->load('members'),
            'roles' => Role::all(),
            'pendingInvitations' => Invitation::where('team_id', $team->id)
                ->whereNull('accepted_at')->latest(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, User $user)
    {
        if ($user->belongsToTeam($team)) {
            $user->delete();
        }

        return $this->response()->back(303);
    }
}
