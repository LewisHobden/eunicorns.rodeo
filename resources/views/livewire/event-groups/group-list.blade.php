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
