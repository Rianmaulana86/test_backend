<?php
namespace App\Services;

use App\Models\User;
use App\Responses\ServerResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function App\Helpers\error;

class AuthService
{
    public function register(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new HttpResponseException(response()->json([
                'rc' => '422',
                'message' => $errors,
                'data' => null
            ]));
        }

        $user = User::create([
            'name' => $data['name'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = JWTAuth::fromUser($user);
        

        return ['token' => $token];
    }

    public function login(array $credentials)
    {
       
            if (!$token = Auth::attempt($credentials)) {
                throw new HttpResponseException(error(ServerResponse::INVALID_CREDENTIALS, 401));
            }
            
            return ['token' => $token];

    }

    public function logout()
    {
        try {
            // Mendapatkan token dari request
            $token = JWTAuth::getToken();
            // Mencabut token
            JWTAuth::invalidate($token);

            return ['token' => $token];
           
        } catch (\Exception $e) {
            // Menangani kesalahan jika token tidak valid atau tidak ditemukan
            throw new HttpResponseException(error(ServerResponse::INVALID_CREDENTIALS));
        }

       
    }

    public function user()
    {
        return response()->json(Auth::user());
    }
}
