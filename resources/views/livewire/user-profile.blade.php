<div>
    <div class="modal-header">
        <h5 class="modal-title">{{ __('Profile') }}</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div id="profileBackgroundImage"></div>
        <div class="d-flex flex-column gap-2 align-items-center align-items-md-start">
            <img src="https://api.dicebear.com/9.x/initials/svg?seed={{ $this->profile['name'] }}" style="margin-top: -1.5em; border: 5px solid white; z-index: 1;" alt="twbs" width="80" height="80" class="rounded-circle flex-shrink-0">
            <div class="d-flex flex-column">
                <div class="fw-bold mb-2" style="font-size: 1.5em;">{{ $this->profile->name }}</div>
                <div class="text-decoration-underline" style="font-size: 1em;">{{ $this->profile->email }}</div>
                <div class="text-muted" style="font-size: 1em;">{{ __('Member since') }} {{ date('F Y', strtotime($this->profile->created_at)) }}</div>
            </div>
        </div>
        <div class="my-4"></div>
        <div class="d-flex gap-1">
        </div>
        <h4>{{ __('Liked Dogs') }}</h4>
        <hr>
        @if($this->profile->likes->isEmpty())
            <div class="text-muted mb-3">{{ __('No available liked dogs') }}</div>
        @else
            <div class="row g-3 mb-3">
                @foreach($this->profile->likes as $dog)
                @php $image = json_decode((new \App\Services\API)->getData('https://dog.ceo/api/breed/'.explode('-', $dog->name)[0].'/images/random'))->message; @endphp
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $image }}" class="card-img-top" alt="{{ $dog->name }}'s image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dog->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
