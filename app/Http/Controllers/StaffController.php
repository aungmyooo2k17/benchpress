<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Inertia\Inertia;
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
            'team' => $team->load('invitations', 'members'),
            'roles' => Role::all(),
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
