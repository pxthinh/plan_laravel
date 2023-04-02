<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    /**
     * Handle Queue Process
     */
    public function processQueue()
    {
        $details['email'] = 'pxthinh.vn@gmail.com';
        $emailJob = new SendWelcomeEmail($details);
        dispatch($emailJob);
        return response()->json(['message' => 'Ok'],JsonResponse::HTTP_OK);
    }
}
