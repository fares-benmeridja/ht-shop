<?php

namespace App\Http\Controllers;


use App\Http\Requests\ManageAdminRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class AdminManagerController extends Controller
{

    private const PERPAGE = 15;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AdminManagerController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->authorizeResource(User::class, 'admin');
    }

    public function index()
    {
        $admins = User::communeWithWilaya()->admin()->orderBy('created_at', 'desc')->simplePaginate(self::PERPAGE);
        $admins->load('role');

        return view('admin.account.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.account.create', compact('roles'));
    }

    public function store(RegisterUserRequest $request)
    {
        $this->userRepository->store($request->all());

        session()->flash('success', "Admin created successfully.");
        return $request->ajax()
            ? response()->json(['route' => route('admins.index')])
            : redirect()->route('admins.index');
    }

    public function edit(User $admin){
        $roles = Role::pluck('name', 'id');
        $title = 'Edit admin';
        return view('admin.account.edit-admin', compact('admin', 'roles', 'title'));
    }

    public function update(ManageAdminRequest $request, User $admin)
    {
        $this->userRepository->update($admin, $this->params($request));

        session()->flash('success', "Admin updated successfully.");

        return $request->ajax()
            ? response()->json(['route' => route('admins.index')])
            : redirect()->route('admins.index');
    }

    private function params($request)
    {
        $user = Auth::user();
        if ($user->can('manageAdmins')){
            return $request->all();
        }

        return $request->except('role_id');
    }

    public function destroy(User $admin)
    {

        $this->userRepository->destroy($admin);

        session()->flash('success', "Admin deleted successfully.");

        return request()->ajax()
            ? response()->json(['route' => route('admins.index')])
            : redirect()->route('admins.index');
    }
}
