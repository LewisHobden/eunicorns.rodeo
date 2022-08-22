<div class="dropdown">
    <div class="signup-action" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-plus-circle"></i>
    </div>
    <ul class="dropdown-menu">
        @foreach($groups as $group)
            <li>
                <a wire:click="signup({{ $group->id }})"
                   class="dropdown-item" href="#">{{ $group->group_name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
