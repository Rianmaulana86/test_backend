<?php
namespace App\Services;

use App\Models\Role;
use App\Responses\ServerResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use function App\Helpers\error;

class RoleService
{
   public function getRoleAll() {

        try {
            $role = Role::all();
            if (!$role) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $role;

   }


   public function getRoleById($id) {

        try {
            $role = Role::find($id);
            if (!$role) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $role;

    }



    public function createRole($data) {

        try {

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $role = Role::create([
                'name' => $data['name'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $role;

    }




    public function updateRoleById($id, $data) {

        try {
            $role = Role::find($id);
            
            if (!$role) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $role->update([
                'name' => $data['name'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $role;

    }


    public function deleteRoleById($id) {

        try {
            $role = Role::find($id);
            if (!$role) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
            $role->delete();
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $role;

    }




}
