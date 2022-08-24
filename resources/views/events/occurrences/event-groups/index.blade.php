@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Raid Groups') }}</div>
                    <div class="card-body">
                        <x-session-message/>
                        <p><a class="btn btn-primary" href="{{ route("occurrences.groups.create", $occurrence) }}">New
                                Group</a></p>


                    </div>
                </div>
                <hr />
                <livewire:event-groups.player-list :occurrence="$occurrence" />
                <hr />
                <livewire:event-groups.group-list :occurrence="$occurrence" />
        </div>
    </div>
    </div>
@endsection
