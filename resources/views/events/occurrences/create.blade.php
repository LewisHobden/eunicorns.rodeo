@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">New Occurrence for Event: {{ $event->event_title }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("events.occurrences.store", $event) }}">
                            @csrf

                            <x-forms.input property="occurrence_date" type="datetime-local" label="Date" />

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
