@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modify Event') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("event.update", $event) }}">
                                @csrf
                                @method("PUT")

                                <x-forms.input value="{{ $event->event_title }}" property="event_title" type="text" label="Event Title" />
                                <x-forms.input value="{{ $event->scheduled_date->format('Y-m-d') }}" property="scheduled_date" type="date" label="Date Scheduled" />
                                <x-forms.input value="{{ $event->item_level }}" property="item_level" type="number" label="Required Item Level" />
                                <x-forms.input value="{{ $event->player_limit }}" property="player_limit" type="number" label="Player Limit" />

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
