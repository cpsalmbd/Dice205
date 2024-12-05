@extends('layouts.app')

@section('content')
    <div class="container">
        @session('success')
            <div class="alert alert-success alert-dismissible fade show rounded-0 border-0 shadow-sm" role="alert">
                {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        <form action="{{ route('profileUpdate', auth()->id()) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group mb-3">
                <label for="name">{{ __('Name') }}</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="e.g John Doe"
                    @class([
                        'form-control rounded-0',
                        'is-invalid' => $errors->has('name'),
                        'is-valid' => !$errors->has('name') && old('name')
                    ])
                    value="{{ old('name', auth()->user()->name) }}"
                />
                @error('name')
                    <span class="text-danger fw-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email">{{ __('Email') }}</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="e.g johndoe@gmail.com"
                    @class([
                        'form-control rounded-0',
                        'is-invalid' => $errors->has('email'),
                        'is-valid' => !$errors->has('email') && old('email')
                    ])
                    value="{{ old('email', auth()->user()->email) }}"
                />
                @error('email')
                    <span class="text-danger fw-bold">{{ $message }}</span>
                @enderror
            </div>
            <button
                type="submit"
                class="btn btn-primary rounded-0 mt-4"
                onclick="
                    this.disabled=true;
                    this.innerHTML='Saving...';
                    document.getElementById('name').setAttribute( 'readonly', true );
                    document.getElementById('email').setAttribute( 'readonly', true );
                    this.form.submit();
                "
            >{{ __('Save Changes') }}</button>
        </form>
    </div>
@endsection
