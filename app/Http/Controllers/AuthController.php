<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class AuthController extends BaseController
{
    /**
     * Register user 
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {

            // Get all validated data 
            $data = $request->validated();

            // Check if profile exists
            if(!$request->hasFile('profile')) {
                return $this->sendError("Profile doesn't exist please choose a valid file.");
            }

            // get profile tmp name 
            $tmp = $request->file('profile');

            // profile name 
            $filename = time().'_'.$tmp->getClientOriginalName();

            // Set destination 
            $destination = public_path('images');

            // Upload profile 
            if($tmp->isValid()) {
                $full_path = $tmp->move($destination, $filename);
            } else {
                return $this->sendError('Invalid file. Please choose a valid file.');
            }


            // Format data 
            $data['profile'] = $filename;
            $data['password'] = Hash::make($data['password']);
            $data['hobbies'] = implode('[,', $data['hobbies']);

            //Create user 
            $user = User::create($data);

            return $this->sendResponse($user, "Successfully registered, $full_path");
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Login user
     */
    public function login() {
        echo "Login";
    }
}
