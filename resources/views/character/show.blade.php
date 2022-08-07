@extends('layouts.app')

@section('content')
    <div class="container bg-dark">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your Characters') }}</div>

                    <div class="card-body">
                        @foreach ($characters as $character)
                            <div class="alert alert-success" role="alert">
                                {{ $character->in_game_name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
