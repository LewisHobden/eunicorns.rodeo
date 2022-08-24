@extends('layouts.app')

@section('content')
    @guest
        <div class="container">
            <div class="row justify-content-center">
                <div class="content">
                    <div class="card">
                        <div class="card-header">{{ __('EUnicorns') }}</div>
                        <div class="card-body">
                            <p class="alert alert-warning">This site is in beta. Please <a href="{{ route('login') }}">login</a> to continue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }}</div>
                    <div class="card-body">
                        <p class="alert alert-primary">Welcome to the EUnicorns site. Right now you can only use this site to register for our guild events. More to come!</p>
                        <p><a class="btn btn-primary" href="{{ route('characters.index') }}">View your Roster</a></p>
                    </div>
                </div>
                <hr />
                <div class="card">
                    <div class="card-header">{{ __('Upcoming Guild Events') }}</div>
                    <div class="card-body d-grid" style="grid-template-columns: 50% 50%">
                        @foreach($upcoming_events as $event)
                            <div class="card m-1">
                                <img src="{{ asset('images/event-banners/'.$event->event_type->value.'.png') }}" class="card-img-top" alt="Event Banner">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->event_title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Required item level: <b>{{ $event->item_level }}</b></h6>
                                </div>
                                <ul class="list-group">
                                    @foreach($event->occurrences as $occurrence)
                                        <li class="list-group-item  d-flex justify-content-between align-items-center">
                                            {{ $occurrence->scheduled_datetime->format("l jS \a\\t H:i") }}
                                            <signup-component
                                                :occurrence="{{ json_encode($occurrence) }}"
                                                :registered="{{ Auth::user()->isSignedUp($occurrence) ? "true" : "false" }}" />
                                        </li>
                                   @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endguest
@endsection
