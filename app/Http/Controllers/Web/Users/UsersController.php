<?php

namespace Vanguard\Http\Controllers\Web\Users;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Vanguard\Events\User\Deleted;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\User\CreateUserRequest;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Role;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\User;

/**
 * Class UsersController
 * @package Vanguard\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display paginated list of all users.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
//        $users = $this->users->paginate($perPage = 20, $request->search, $request->status);
        $query = User::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('roles') && $request->roles != '') {
            $query->where('role_id', $request->roles);
        }
        if (\Auth::user()->role_id == 3) {
            $query->where('role_id', 2);
        }
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('username', "like", "%{$request->search}%");
                $q->orWhere('email', 'like', "%{$request->search}%");
                $q->orWhere('first_name', 'like', "%{$request->search}%");
                $q->orWhere('last_name', 'like', "%{$request->search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->simplePaginate(12);
        $statuses = ['' => __('All')] + UserStatus::lists();
        $roles = ['' => __('All')] + Role::all()->pluck('name', 'id')->toArray();
        return view('user.list', compact('users', 'statuses', 'roles'));
    }

    /**
     * Displays user profile page.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('user.view', compact('user'));
    }

    /**
     * Displays form for creating a new user.
     *
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return Factory|View
     */
    public function create(CountryRepository $countryRepository, RoleRepository $roleRepository)
    {
        $query = Role::query();
        if (\Auth::user()->role_id == 3) {
            $query->where('id', 2);
        }
        return view('user.add', [
            'countries' => $this->parseCountries($countryRepository),
            'roles' => $query->pluck('name', 'id'),
            'statuses' => UserStatus::lists()
        ]);
    }

    /**
     * Parse countries into an array that also has a blank
     * item as first element, which will allow users to
     * leave the country field unpopulated.
     *
     * @param CountryRepository $countryRepository
     * @return array
     */
    private function parseCountries(CountryRepository $countryRepository)
    {
        return [0 => __('Select a Country')] + $countryRepository->lists()->toArray();
    }

    /**
     * Stores new user into the database.
     *
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function store(CreateUserRequest $request)
    {
        // When user is created by administrator, we will set his
        // status to Active by default.
        $data = $request->all() + [
                'status' => UserStatus::ACTIVE,
                'email_verified_at' => now()
            ];

        if (!data_get($data, 'country_id')) {
            $data['country_id'] = null;
        }

        // Username should be updated only if it is provided.
        if (!data_get($data, 'username')) {
            $data['username'] = null;
        }

        $this->users->create($data);

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Displays edit user form.
     *
     * @param User $user
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return Factory|View
     */
    public function edit(User $user, CountryRepository $countryRepository, RoleRepository $roleRepository)
    {
        return view('user.edit', [
            'edit' => true,
            'user' => $user,
            'countries' => $this->parseCountries($countryRepository),
            'roles' => $roleRepository->lists(),
            'statuses' => UserStatus::lists(),
            'socialLogins' => $this->users->getUserSocialLogins($user->id)
        ]);
    }

    /**
     * Removes the user from database.
     *
     * @param User $user
     * @return $this
     */
    public function destroy(User $user)
    {
        if ($user->is(auth()->user())) {
            return redirect()->route('users.index')
                ->withErrors(__('You cannot delete yourself.'));
        }

        $this->users->delete($user->id);

        event(new Deleted($user));

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }

    public function findCustomer(Request $request)
    {
        $user = User::where('phone', '=', $request->phone)->firstOrFail();
        return response()->json([
            'full_name' => $user->first_name . " " . $user->last_name,
            'address' => $user->address,
            'email' => $user->email,
            'number_plate' => $user->cars[0]->number_plate,
            'engine_number' => $user->cars[0]->engine_number,
            'attributes' => $user->cars[0]->attributes->pluck('id')
        ]);
    }
}
