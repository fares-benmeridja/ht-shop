<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return abort(404);
    }

    public function redirectPath()
    {
        return $this->routeResponse();
    }

    private function routeResponse()
    {
        return auth()->user()->is_user
            ? route('main')
            : route('dashboard');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterUserRequest $request
     * @return mixed
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userRepository->store($request->all());
        event(new Registered($user));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? response()->json(['route' => $this->routeResponse()])
            : redirect()->intended($this->redirectPath());
    }
}
