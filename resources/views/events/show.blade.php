@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modify Event') }}</div>
                    <div class="card-body">
                        <x-session-success />

                        <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">Edit Event</a>
                        <p>{{ $event->scheduled_date }}</p>
                        <p>{{ $event->event_title }}</p>
                        <p>{{ $event->item_level }}</p>
                        <p>{{ $event->player_limit }}</p>

                        <h3>Occurrences</h3>
                        <p>What dates and times is this event running?</p>

                        <a href="{{ route('events.occurrences.create', $event) }}" class="btn btn-primary">Add Occurrence</a>
                        @if(0 === count($event->occurrences))
                            <p class="alert alert-warning">No occurrences planned for this event yet.</p>
                        @else
                            <ul class="list-group">
                                @foreach($event->occurrences as $occurrence)
                                    <li class="list-group-item">{{ $occurrence->scheduled_datetime }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
