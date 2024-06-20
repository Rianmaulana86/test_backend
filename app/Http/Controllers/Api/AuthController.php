<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Responses\ServerResponse;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\success;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password', 'role_id');
        $register = $this->authService->register($data);
        return success(ServerResponse::SUCCESS_CREATE, $register);
    }

    public function login(Request $request)
    {

        $data = $request->only('email', 'password');
        $login = $this->authService->login($data);
        
        return success(ServerResponse::SUCCESS_LOGIN, $login);

    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        return success(ServerResponse::SUCCESS_LOGOUT);
    }

    public function user(Request $request)
    {
        return $this->authService->user();
    }
}