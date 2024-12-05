<div class="card card-body rounded-0 shadow-sm bg-white border-0" wire:init="loadMore">
    <p class="fw-bold">{{ __('People you may know') }} ({{ $this->userCount }})</p>
    <div id="userList" class="list-group" style="height:auto; max-height: 29em; overflow-y: scroll">
        @foreach($this->users as $user)
            <a
                href="javascript:void(0);"
                wire:click="$dispatch('showModal', {data: {'alias' : 'userProfile','params' :{'id': {{ $user['id'] }} }}})"
                class="hoverable list-group-item bg-transparent border-0 list-group-item-action d-flex gap-3 py-3"
                aria-current="true"
            >
                <img src="https://api.dicebear.com/9.x/initials/svg?seed={{ $user['name'] }}" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">{{ $user['name'] }}</h6>
                        <p class="mb-0 opacity-75">
                            @if($user['likes_count'] == 0)
                                {{ __('No Liked Dogs') }}
                            @else
                                {{ $user['likes_count'] }}{{ __('/3 Liked Dogs') }}
                            @endif
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
        @if($this->userCount != count($this->users))
            <a
                href="javascript:void(0);"
                class="hoverable list-group-item bg-transparent border-0 list-group-item-action d-flex gap-3 text-muted"
                wire:click="loadMore"
            >
                {{ __('Load More...') }}
            </a>
        @endif
    </div>
    @if(count($this->users) == 0)
        <div class="text-muted">
            {{ __('No user available') }}
        </div>
    @endif
</div>
