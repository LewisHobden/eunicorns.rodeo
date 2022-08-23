@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Open Events') }}</div>
                    <div class="card-body">
                        <x-session-message />
                        <p><a class="btn btn-primary" href="{{ route("events.create") }}">New Event</a></p>

                        @if(empty($open_events) || count($open_events) === 0)
                            No events currently open for signups.
                            <a href="{{ route("events.create") }}">Click here to add one</a>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Player Limit</th>
                                        <th scope="col">Signups Open?</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($open_events as $event)
                                    <tr>
                                        <td>{{ $event->event_title }}</td>
                                        <td>{{ $event->player_limit }}</td>
                                        <td>@if($event->is_signup_open)Yes @else No @endif</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('events.show', $event) }}">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
