<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Http\Responses\MemberResponse;
use App\Actions\Member\CreateNewMember;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        return Inertia::render('Members/Index', [
            'members' => $team->customers()->latest()->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return Inertia::render('Members/Create', [
            'subscriptions' => $team->subscriptionProducts(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request, CreateNewMember $creator)
    {
        $member = $creator->create($request->validated());

        return MemberResponse::dispatch($member);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Member $member)
    {
        return Inertia::render('Members/Edit', [
            'member' => $member,
            'subscriptions' => $team->subscriptionProducts(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member       $member
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
    }
}
