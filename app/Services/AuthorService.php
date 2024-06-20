<?php
namespace App\Services;

use App\Models\Author;
use App\Responses\ServerResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use function App\Helpers\error;

class AuthorService
{
   public function getAuthorAll() {

        try {
            $author = Author::all();
            if (!$author) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $author;

   }


   public function getAuthorById($id) {

        try {
            $author = Author::find($id);
            if (!$author) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $author;

    }



    public function createAuthor($data) {

        try {

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $author = Author::create([
                'name' => $data['name'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $author;

    }




    public function updateAuthorById($id, $data) {

        try {
            $author = Author::find($id);
            
            if (!$author) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $author->update([
                'name' => $data['name'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $author;

    }


    public function deleteAuthorById($id) {

        try {
            $author = Author::find($id);
            if (!$author) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
            $author->delete();
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $author;

    }




}
