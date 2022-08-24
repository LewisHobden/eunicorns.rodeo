<div class="dropdown">
    @if (session('error'))
        <div class="signup-action" type="button">
            <i class="bi bi-exclamation-circle"></i>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>

    <script>
        const toastLiveExample = document.getElementById('liveToast');
        const toast = new window.bootstrap['toast'](toastLiveExample);

        toast.show();
    </script>
    @elseif($existing_group)
        <div class="signup-action" type="button">
            <a wire:click="remove({{ $existing_group->id }})">
                <i class="bi bi-calendar2-x"></i>
            </a>
        </div>
    @elseif($character->user->isOccupied($occurrence))
        <div></div>
    @else
    <div class="signup-action" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-plus-circle"></i>
    </div>
    @endif
    <ul class="dropdown-menu">
        @foreach($groups as $group)
            <li>
                <a wire:click.prevent="signup({{ $group->id }})"
                   class="dropdown-item" href="#">{{ $group->group_name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
