<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdatePassRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class ProfilController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profil()
    {
        return auth()->user()->is_user
            ? view('client.profils.update')
            : view('admin.account.update');
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->all());

        session()->flash('success', "Account updated successfuly");

        return $request->ajax()
            ? response()->json(['route' => route('profil')])
            : redirect()->route('profil');
    }

    public function updatePass(UserUpdatePassRequest $request, User $user)
    {
        $this->userRepository->update($user, ['password' => $request->password]);

        session()->flash('success', "Password updated successfuly");

        return $request->ajax()
            ? response()->json(['route' => route('profil')])
            : redirect()->route('profil');
    }
}
