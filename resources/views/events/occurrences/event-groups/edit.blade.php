@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Edit Raid Group') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("occurrences.groups.update", [$group->occurrence, $group]) }}">
                            @csrf
                            @method('PUT')

                            <x-forms.input :value="$group->group_name" property="group_name" type="text" label="Group Name"/>
                            <x-forms.input :value="$group->discord_role_id" property="discord_role_id" type="text" label="Discord Role ID"/>
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
