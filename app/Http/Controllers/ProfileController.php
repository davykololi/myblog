<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Traits\AvatarUploadTrait;

class ProfileController extends Controller
{
    use AvatarUploadTrait;
    /**
     * Display the user's profile form.
     */
    public function edit(): Response
    {
        $user = Auth::user();

        return Inertia::render('Profile/Edit',compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->hasRole('author')){
            $user->profile->updateOrCreate([
                'name'=> $name,
                'email' =>  $email,
                'avatar' => $this->verifyAndUpload($request,'avatar','/storage/'),
                'country' => $request->country,
                'city' => $request->city,
                'postal_address' => $request->postal_address,
                'postal_code' => $request->postal_code,
                'facebook_link' => $request->facebook_link,
                'x_link' => $request->x_link,
                'linkedin_link' => $request->linkedin_link,
                'instagram_link' => $request->instagram_link,
                'twitter_site' => $request->twitter_site,
            ]);

            return Redirect::route('profile.edit');
        } elseif($user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('visitor')){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return Redirect::route('profile.edit');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
