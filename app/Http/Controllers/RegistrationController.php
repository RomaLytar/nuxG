<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Facades\ModelSaverFacade as ModelSaver;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $data = [
            'name' => $request->username,
            'phonenumber' => $request->phonenumber,
            'email' => Str::random(10) . '@example.com', // temporary email
            'password' => bcrypt('password'), // default password
            'unique_link' => Str::random(32),
            'link_expires_at' => Carbon::now()->addDays(User::COUNT_ACTIVATE_LINK), // activate link 7 day
        ];
        $user = ModelSaver::save(new User(), $data);
        return redirect()->back()->with('link', route('pageA', $user->unique_link));
    }
}
