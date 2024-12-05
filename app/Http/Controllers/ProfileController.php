<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile');
    }

    public function update(ProfileRequest $request, $id): RedirectResponse
    {
        $request->validated();

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back()->withSuccess('Profile Updated Successfully');
    }
}
