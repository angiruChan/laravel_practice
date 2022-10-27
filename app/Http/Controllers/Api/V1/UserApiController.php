<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\ListUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserApiController extends Controller
{
    public function index(ListUserRequest $request)
    {
        $users = User::paginate($request->per_page ?? 10);

        return UserResource::collection($users);
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            return response()->json([
                'data' => new UserResource($user),
                'message' => 'User created successfully.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(User $user)
    {
        return response()->json([
            'data' => new UserResource($user),
            'message' => 'User created successfully.',
        ], Response::HTTP_OK);
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());

            return response()->json([
                'data' => new UserResource($user),
                'message' => 'User updated successfully.',
            ], Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
