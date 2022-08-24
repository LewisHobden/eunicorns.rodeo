<div class="card">
    <div class="card-header">Players</div>
    <div class="d-grid" style="grid-template-columns: 33% 33% 33%">
        @foreach($players as $player)
            <div class="card">
                <div class="card-header @if($occupied = $player->user->isOccupied($occurrence)) text-bg-success @endif">
                    {{ $player->user->name }}
                    @if($occupied)
                        (occupied)
                    @endif
                </div>
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
                                <livewire:event-groups.group-assignment key="{{ $character->id }}" :character="$character" :occurrence="$occurrence" />
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
