<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function getPhone()
    {
        $phone = User::find(1)->phone;
        return response()->json(['success' => 'Ok', 'data' => $phone],JsonResponse::HTTP_OK);
    }

    public function getPost()
    {
        $latestPost = User::find(1)->latestPost;
        $oldestPost = User::find(1)->oldestPost;
        $largestPost = User::find(1)->largestPost;

        return response()->json(['success' => 'Ok', 'latestPost' => $latestPost, 'oldestPost' => $oldestPost, 'largestPost' => $largestPost],JsonResponse::HTTP_OK);
    }

    public function getRoles()
    {
        $roles = User::find(1)->roles;
        return response()->json(['success' => 'Ok', 'data' => $roles],JsonResponse::HTTP_OK);
    }
}