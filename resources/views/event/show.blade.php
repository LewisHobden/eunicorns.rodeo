@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modify Event') }}</div>
                    <div class="card-body">
                        <x-session-success />

                        <a href="{{ route('event.edit', $event) }}" class="btn btn-primary">Edit Event</a>
                        <p>{{ $event->scheduled_date }}</p>
                        <p>{{ $event->event_title }}</p>
                        <p>{{ $event->item_level }}</p>
                        <p>{{ $event->player_limit }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
