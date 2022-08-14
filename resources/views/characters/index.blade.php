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
                                <p>Click a character to edit their details.</p>
                            </div>
                            @if(empty($characters) || count($characters) === 0)
                                You have no characters recorded.
                                <a href="{{ route("characters.create") }}">Click here to add one</a>
                            @else
                                <ul class="list-group">
                                    @foreach ($characters as $character)
                                        <a class="list-group-item list-group-item-dark list-group-item-action character"
                                           href="{{ route('characters.edit', $character) }}">
                                            <x-class-icon :class="$character->class" />
                                            <p class="character-name">{{ $character->in_game_name}}</p>
                                            <p class="character-summary">{{ $character->item_level }} {{ $character->class->toFriendly() }}</p>
                                        </a>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<style>
    .character {
        display: grid;
        grid-template-columns: 20% 40% 40%;
    }

    .character-name {
        font-size: 1.2em;
        font-weight: bold;
        padding: 5px;
    }

    .character-summary {
        text-align: right;
        font-size: 0.9em;
    }

    @media(max-height: 480px) {
        .character-summary {
            display: none;
        }

        .character {
            display: grid;
            grid-template-columns: 30% 70%;
        }
    }

    .class-icon__container {
        max-height: 50px;
    }

    .class-icon {
        height: 100%;
        width: auto;
    }
</style>
@endsection
