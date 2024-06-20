<?php
namespace App\Services;

use App\Models\User;
use App\Responses\ServerResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function App\Helpers\error;

class UserService
{
   public function getUserAll() {

        try {
            $user = User::all();
            if (!$user) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $user;

   }


   public function getUserById($id) {

        try {
            $user = User::find($id);
            if (!$user) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $user;

    }




    public function updateUserById($id, $data) {

        try {

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'role_id' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $user = User::find($id);

            if (!$user) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $user;

    }


    public function deleteUserById($id) {

        try {
            $user = User::find($id);
            if (!$user) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
            $user->delete();
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $user;

    }




}
