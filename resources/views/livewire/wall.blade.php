<div wire:init="init">
    @if($loading)
        {{-- <div class="filter">
            <input type="text" class="form-control rounded-0 bg-white mb-3" placeholder="Search..." />
            <div class="d-flex gap-3 mb-3">
                <select class="form-select rounded-0 bg-white">
                    <option value="">{{ __('Breed') }}</option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <select class="form-select rounded-0 bg-white">
                    <option value="">{{ __('Type') }}</option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
        </div> --}}
        {{-- <div class="d-flex gap-2 align-items-end mb-3">
            <h5 class="mb-0">{{ __('Welcome,') }} </h5>
            <span class="fw-bold">{{ auth()->user()->name }}</span>
        </div> --}}
        <div id="wall" class="d-flex flex-column gap-4" style="height: 800px; overflow-y: scroll;">
            @foreach($this->data as $item)
                <div class="card rounded-0 shadow-sm bg-white border-0 w-100 rounded-0">
                    <img src="{{ $item->image }}" class="card-img-top rounded-0" alt="{{ $item->name }}'s Image" loading="lazy">
                    <div class="card-body">
                        <section class="mb-3">
                            <h5 class="card-title text-capitalize">{{ $item->name }}</h5>
                        </section>
                        {{-- <p class="card-text mb-0 opacity-75">{{ fake()->firstName }} {{ __('and 6 others also like this') }}</p> --}}
                        <div class="mt-3 py-2 border-none border-top border-bottom">
                            <a href="javascript:void" class="text-{{ in_array($item->name, $likes) ? 'primary fw-bold' : 'muted' }} text-decoration-none hoverable" wire:loading.class="pe-none" wire:target="react" wire:click="react('{{ $item->name }}')">
                                <div class="d-flex gap-1 justify-content-center align-items-center">
                                    <i class="bi bi-hand-thumbs-up" style="font-size: 1em;"></i>
                                    <span>{{ __('Like') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($this->limit+$this->offset != 201)
                <div class="d-none" wire:loading.class.remove="d-none" wire:target="loadMore">
                    <div class="d-flex flex-column gap-4 placeholder-glow">
                        @for($i = 0; $i < 3; $i++)
                            <div class="card rounded-0 shadow-sm bg-white border-0 w-100 rounded-0">
                                <div class="placeholder col-12" style="height: 30em;"></div>
                                <div class="card-body">
                                    <div class="placeholder col-12 col-md-5 col-lg-5 col-xl-5" style="height: 1.3em;"></div>
                                    <div class="mt-3 py-2 border-none border-top border-bottom">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="placeholder col-4 col-md-1 col-lg-1 col-xl-1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <button wire:click.prevent="loadMore" class="btn btn-primary btn-sm rounded-0" wire:loading.class="pe-none opacity-50" wire:target="loadMore" >
                    <div wire:loading.class="d-none" wire:target="loadMore">{{ __('Load More...') }}</div>
                    <div class="d-none" wire:loading.class.remove="d-none" wire:target="loadMore">{{ __('Loading...') }}</div>
                </button>
            @else
                <span class="text-center text-muted opacity-75 cursored">{{ __('You reach the end of the page') }}</span>
            @endif
        </div>
    @else
        <div class="d-flex flex-column gap-4 placeholder-glow">
            @for($i = 0; $i < 3; $i++)
                <div class="card rounded-0 shadow-sm bg-white border-0 w-100 rounded-0">
                    <div class="placeholder col-12" style="height: 30em;"></div>
                    <div class="card-body">
                        <div class="placeholder col-12 col-md-5 col-lg-5 col-xl-5" style="height: 1.3em;"></div>
                        <div class="mt-3 py-2 border-none border-top border-bottom">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="placeholder col-4 col-md-1 col-lg-1 col-xl-1"></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            <div class="placeholder col-12" style="height: 2em;"></div>
        </div>
    @endif
</div>
