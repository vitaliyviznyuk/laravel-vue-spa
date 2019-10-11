<?php
/**
 * @author Vitaliy Viznyuk <vitaliyviznyuk@gmail.com>
 * @copyright Copyright (c) 2019 Vitaliy Viznyuk
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UsersController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate(10));
    }

    /**
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * @param User $user
     * @param Request $request
     *
     * @return UserResource
     */
    public function update(User $user, Request $request): UserResource
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->update($data);

        return new UserResource($user);
    }
}
