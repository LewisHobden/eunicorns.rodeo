@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Event Details') }}</div>
                    <div class="card-body">
                        <x-session-message />

                        <x-event-groups.group-detail :event="$event" />
                    </div>
                    <div class="card-body">
                        <a href="{{ route('events.edit', $event) }}" class="card-link">Edit Event</a>
                        <a href="{{ route('events.occurrences.create', $event) }}" class="card-link">Add Occurrence</a>
                        <a href="#" onclick='alert("Feature coming soon")' class="btn btn-outline-danger card-link">Close Signups</a>
                    </div>
                </div>
                <hr />
                @if(0 === count($event->occurrences))
                    <p class="alert alert-warning">No occurrences planned for this event yet.</p>
                @else
                    <div class="d-flex">
                    @foreach($event->occurrences as $occurrence)
                        <div class="card">
                            <div class="card-header">{{ $occurrence->scheduled_datetime->toRfc850String() }}</div>
                            <div class="card-body">
                                {{ count($occurrence->signups) }} signup(s) to this occurrence.
                            </div>
                            @if(count($occurrence->signups) !== 0)
                            <ul class="list-group">
                                @foreach($occurrence->signups as $signup)
                                <li class="list-group-item">
                                    {{ $signup->user->name }}
                                    ({{ count($signup->user->characters) }} character(s))
                                </li>
                                @endforeach
                            </ul>
                         @endif
                            <div class="card-body">
                                <a href="{{ route('occurrences.groups.index', $occurrence) }}" class="card-link">
                                    Manage Raid Groups
                                </a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif
        </div>
    </div>
@endsection
