@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your Characters') }}</div>
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{ route("character.create") }}">New Character</a>
                            @if(empty($characters) || count($characters) === 0)
                                You have no characters recorded.
                                <a href="{{ route("character.create") }}">Click here to add one</a>
                            @else
                                @foreach ($characters as $character)
                                    <div>
                                        {{ $character->in_game_name}}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
