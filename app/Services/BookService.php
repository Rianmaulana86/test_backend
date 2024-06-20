<?php
namespace App\Services;

use App\Models\Book;
use App\Responses\ServerResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use function App\Helpers\error;

class BookService
{
   public function getBookAll() {

        try {
            $book = Book::all();
            if (!$book) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $book;

   }


   public function getBookById($id) {

        try {
            $book = Book::find($id);
            if (!$book) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $book;

    }



    public function createBook($data) {

        try {

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'author_id' => 'required|string|max:255',
                'price' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $book = Book::create([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'author_id' => $data['author_id'],
                'price' => $data['price'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $book;

    }




    public function updateBookById($id, $data) {

        try {
            $book = Book::find($id);
            
            if (!$book) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'author_id' => 'required|string|max:255',
                'price' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $book->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'author_id' => $data['author_id'],
                'price' => $data['price'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $book;

    }


    public function deleteBookById($id) {

        try {
            $book = Book::find($id);
            if (!$book) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
            $book->delete();
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $book;

    }




}
