@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Event') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("events.store") }}">
                            @csrf

                            <x-forms.input property="event_title" type="text" label="Event Title"/>
                            <x-forms.input property="item_level" type="number" label="Required Item Level"/>
                            <x-forms.input property="player_limit" type="number" label="Group Limit"/>

                            <div class="form-group">
                                <label for="event_type">Event Type</label>
                                <select id="event_type"
                                        name="event_type"
                                        class="form-control @error('event_type') is-invalid @enderror">
                                    <option value="">-- Select --</option>

                                    @foreach(\App\Enum\EventTypeEnum::cases() as $event_type_enum)
                                        <option
                                            @if (old('event_type') === $event_type_enum->value) selected @endif
                                        value="{{ $event_type_enum->value }}">
                                            {{ $event_type_enum->toFriendly() }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('event_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

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
