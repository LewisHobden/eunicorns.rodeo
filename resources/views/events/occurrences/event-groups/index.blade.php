@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="content">
                <div class="card">
                    <div class="card-header">{{ __('Raid Groups') }}</div>
                    <div class="card-body">
                        <x-session-message/>
                        <p><a class="btn btn-primary" href="{{ route("occurrences.groups.create", $occurrence) }}">New
                                Group</a></p>


                    </div>
                </div>
                <hr />
                <div class="card">
                    <div class="card-header">Players</div>
                    <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
                        @foreach($players as $player)
                        <div class="card">
                            <div class="card-header">{{ $player->user->name }}</div>
                            <ul class="list-group">
                                @foreach($player->user->characters as $character)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-2">
                                            <div class="m-auto">
                                                <x-class-icon modifier="small" :class="$character->class"></x-class-icon>
                                            </div>
                                            <div>
                                                <b>{{ $character->in_game_name }}</b><br />
                                                <span>{{ $character->item_level }} {{ $character->class->toFriendly() }}</span>
                                            </div>
                                        </div>
                                        <livewire:event-groups.group-assignment :character="$character" :groups="$groups" />
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>

                <hr />

                <div class="card">
                    <div class="card-header">Groups</div>
                    <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
                        @foreach($groups as $group)
                            <div class="card">
                                <div class="card-header">{{ $group->group_name }}</div>
                                <ul class="list-group">
                                    @foreach($group->slots() as $slot)
                                        @if(null === $slot)
                                            <li class="list-group-item"></li>
                                        @else
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex gap-2">
                                                        <x-class-icon modifier="small" :class="$slot->character->class"></x-class-icon>
                                                        <b>{{ $slot->character->in_game_name }}</b>
                                                    </div>
                                                    <p>{{ $slot->character->item_level }}</p>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
    </div>
@endsection
