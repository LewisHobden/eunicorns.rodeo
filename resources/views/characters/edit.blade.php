@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Character') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("characters.update", $character) }}">
                                @method('PUT')
                                @csrf

                                <div class="form-group">
                                    <label for="item_level">Item Level</label>
                                    <input id="item_level"
                                           name="item_level"
                                           type="number"
                                           value="{{ $character->item_level }}"
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
