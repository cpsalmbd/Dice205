@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row g-3">
                    <div class="col-lg-8">
                        @livewire('wall')
                    </div>
                    <div class="col-lg-4">
                        @livewire('UserList')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
