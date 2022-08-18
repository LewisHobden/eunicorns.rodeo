@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Raid Groups') }}</div>
                    <div class="card-body">
                        <x-session-success/>
                        <p><a class="btn btn-primary" href="{{ route("occurrences.groups.create", $occurrence) }}">New
                                Group</a></p>

                            <character-list :occurrence-id="{{ $occurrence->id }}"
                                            :groups="{{ json_encode($groups) }}"
                                            :signups="{{ json_encode($players) }}"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script>
    import CharacterList from "../../../../js/components/CharacterList";

    export default {
        components: {CharacterList}
    }
</script>
