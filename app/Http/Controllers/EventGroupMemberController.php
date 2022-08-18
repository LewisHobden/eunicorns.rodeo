<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventGroupMemberRequest;
use App\Http\Requests\UpdateEventGroupMemberRequest;
use App\Models\EventGroupMember;

class EventGroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventGroupMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventGroupMemberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventGroupMember  $eventGroupMember
     * @return \Illuminate\Http\Response
     */
    public function show(EventGroupMember $eventGroupMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventGroupMember  $eventGroupMember
     * @return \Illuminate\Http\Response
     */
    public function edit(EventGroupMember $eventGroupMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventGroupMemberRequest  $request
     * @param  \App\Models\EventGroupMember  $eventGroupMember
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventGroupMemberRequest $request, EventGroupMember $eventGroupMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventGroupMember  $eventGroupMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventGroupMember $eventGroupMember)
    {
        //
    }
}
