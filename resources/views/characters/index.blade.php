@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your Characters') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="p-1">
                                <p><a class="btn btn-primary" href="{{ route("characters.create") }}">New Character</a></p>
                            </div>
                            @if(empty($characters) || count($characters) === 0)
                                You have no characters recorded.
                                <a href="{{ route("characters.create") }}">Click here to add one</a>
                            @else
                                <div class="list-group">
                                    @foreach ($characters as $character)
                                        <div>
                                            <a href="{{ route('characters.edit', $character) }}"
                                               class="list-group-item list-group-item-action">
                                                {{ $character->in_game_name}}
                                            </a>
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
