@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Open Events') }}</div>
                    <div class="card-body">
                        <x-session-success />

                        <div class="p-1">
                            <p><a class="btn btn-primary" href="{{ route("event.create") }}">New Event</a></p>
                        </div>
                        @if(empty($open_events) || count($open_events) === 0)
                            No events currently open for signups.
                            <a href="{{ route("event.create") }}">Click here to add one</a>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Scheduled Date</th>
                                        <th scope="col">Player Limit</th>
                                        <th scope="col">Signups Open?</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($open_events as $event)
                                    <tr>
                                        <td>{{ $event->event_title }}</td>
                                        <td>{{ $event->scheduled_date->toFormattedDateString() }}</td>
                                        <td>{{ $event->player_limit }}</td>
                                        <td>@if($event->is_signup_open)Yes @else No @endif</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('event.show', $event) }}">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
