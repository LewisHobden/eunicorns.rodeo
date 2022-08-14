@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modify Event') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("events.update", $event) }}">
                                @csrf
                                @method("PUT")

                                <x-forms.input value="{{ $event->event_title }}" property="event_title" type="text" label="Event Title" />
                                <x-forms.input value="{{ $event->item_level }}" property="item_level" type="number" label="Required Item Level" />
                                <x-forms.input value="{{ $event->player_limit }}" property="player_limit" type="number" label="Player Limit" />

                                <div class="form-group">
                                    <label for="event_type">Event Type</label>
                                    <select id="event_type"
                                            name="event_type"
                                            class="form-control @error('event_type') is-invalid @enderror">
                                        <option value="">-- Select --</option>

                                        @foreach(\App\Enum\EventTypeEnum::cases() as $event_type_enum)
                                            <option
                                                @if ($event->event_type->value === $event_type_enum->value) selected @endif
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
