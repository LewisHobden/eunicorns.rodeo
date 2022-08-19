@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('New Character') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("characters.store") }}">
                                @csrf

                                <div class="form-group">
                                    <label for="in_game_name">In Game Name</label>
                                    <input id="in_game_name"
                                           name="in_game_name"
                                           type="text"
                                           value=" {{ old('in_game_name') }}"
                                           class="form-control @error('in_game_name') is-invalid @enderror" />

                                    @error('in_game_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <select id="class"
                                           name="class"
                                           class="form-control @error('class') is-invalid @enderror">
                                        <option value="">-- Select --  </option>

                                        @foreach(\App\Enum\CharacterClassEnum::cases() as $class_enum)
                                            <option
                                                @if (old('class') === $class_enum->value) selected @endif
                                                value="{{ $class_enum->value }}">
                                                {{ $class_enum->toFriendly()}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('class')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="item_level">Item Level</label>
                                    <input id="item_level"
                                           name="item_level"
                                           type="number"
                                           value=" {{ old('item_level') }}"
                                           class="form-control @error('item_level') is-invalid @enderror" />

                                    @error('item_level')
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
