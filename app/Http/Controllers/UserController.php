<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollectionResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{


	public function __construct(
		private Service $service,
		private UserRepository $userRepository
	){}


	/**
	 * @return mixed
	 */
	public function index(){

		$users = UserCollectionResource::collection(
			$this->userRepository->paginated()
		);

		return Inertia::render('User/Index', ['users' => $users]);
	}
	/**
	 * Create new user view
	 * @return \Inertia\Response
	 */
	public function create(): \Inertia\Response
	{
		return Inertia::render('User/Create' );
	}

	/**
	 * Store new user
	 * @param UserStoreRequest $request
	 * @return RedirectResponse
	 */
	public function store(UserStoreRequest $request): RedirectResponse
	{
		if($this->service->create($request)){
			return redirect()->route('user.index')->with('success', 'Create user successfully');
		}
		return redirect()->route('user.index')->with('error', 'Error');
	}


	/**
	 * Edit owned article
	 * @param User $article
	 * @return \Inertia\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit(User $user): \Inertia\Response
	{
		return Inertia::render('User/Edit',['user' => $user]);
	}


	/**
	 * Update owned article
	 * @param User $article
	 * @param UserUpdateRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException\
	 */
	public function update(User $user, UserUpdateRequest $request): RedirectResponse
	{

		if($this->service->update($user, $request)){
			return redirect()->route('user.index')->with('message','Update user successfully');
		}
		return redirect()->route('user.index')->with('message','Error');

	}


	/**
	 * Destroy article
	 * @param User $user
	 * @return RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function destroy(User $user): RedirectResponse
	{
		$user->delete();

		return redirect()->back()->with('success', 'Delete user successfully');
	}
}
