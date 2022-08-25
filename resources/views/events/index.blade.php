@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Open Events') }}</div>
                    <div class="card-body">
                        <x-session-message/>
                        <p><a class="btn btn-primary" href="{{ route("events.create") }}">New Event</a></p>

                        @if(empty($open_events) || count($open_events) === 0)
                            No events currently open for signups.
                            <a href="{{ route("events.create") }}">Click here to add one</a>
                        @else
                            <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
                                @foreach($open_events as $event)
                                    <div class="card m-1">
                                        <img src="{{ asset('images/event-banners/'.$event->event_type->value.'.png') }}"
                                             class="card-img-top" alt="Event Banner">
                                        <div class="card-body d-flex">
                                            <div>
                                                <h5 class="card-title">{{ $event->event_title }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">Required item level:
                                                    <b>{{ $event->item_level }}</b></h6>
                                            </div>
                                        </div>
                                        <ul class="list-group">
                                            @foreach($event->occurrences as $occurrence)
                                                <li class="list-group-item  d-flex justify-content-between align-items-center">
                                                    {{ $occurrence->scheduled_datetime->format("l jS \a\\t H:i") }}
                                                    <a class="text-decoration-none"
                                                       href="{{ route('occurrences.groups.index', $occurrence) }}">
                                                        <i class="bi bi-people-fill"></i>
                                                        {{ count($occurrence->signups) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <li class="list-group-item">
                                                <a href="{{ route('events.occurrences.create', $event) }}">
                                                    Add new occurrence
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="card-body">
                                            <a class="btn btn-outline-primary card-link">Close Signups</a>
                                            <a class="card-link"
                                               href="{{ route('events.show',$event) }}">More Details</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
