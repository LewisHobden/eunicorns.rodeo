@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Event') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("event.store") }}">
                                @csrf

                                <x-forms.input property="scheduled_date" type="date" label="Date Scheduled" />
                                <x-forms.input property="event_title" type="text" label="Event Title" />
                                <x-forms.input property="item_level" type="number" label="Required Item Level" />
                                <x-forms.input property="player_limit" type="number" label="Player Limit" />

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
