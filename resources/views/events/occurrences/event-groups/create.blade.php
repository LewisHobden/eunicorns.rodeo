@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('New Raid Group') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("occurrences.groups.store", $occurrence) }}">
                            @csrf

                            <x-forms.input property="group_name" type="text" label="Group Name"/>
                            <x-forms.input property="discord_role_id" type="text" label="Discord Role ID"/>
                            <p>You can get the role ID using Discord developer tools. Right click a role -> Copy ID</p>

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
