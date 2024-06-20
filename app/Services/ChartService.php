<?php
namespace App\Services;

use App\Models\Chart;
use App\Responses\ServerResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use function App\Helpers\error;

class ChartService
{
   public function getChartAll() {

        try {
            $chart = Chart::all();
            if (!$chart) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $chart;

   }


   public function getChartById($id) {

        try {
            $chart = Chart::find($id);
            if (!$chart) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $chart;

    }



    public function createChart($data) {

        try {

            $validator = Validator::make($data, [
                'book_id' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $chart = Chart::create([
                'book_id' => $data['book_id'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $chart;

    }




    public function updateChartById($id, $data) {

        try {
            $chart = Chart::find($id);
            
            if (!$chart) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }

            $validator = Validator::make($data, [
                'book_id' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) { 
                throw new HttpResponseException(error(ServerResponse::VALIDATION));
            }

            $chart->update([
                'book_id' => $data['book_id'],
            ]);

        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $chart;

    }


    public function deleteChartById($id) {

        try {
            $chart = Chart::find($id);
            if (!$chart) {
                throw new HttpResponseException(error(ServerResponse::DATA_NOT_FOUND));
            }
            $chart->delete();
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage(), JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(ServerResponse::INTERNAL_SERVER_ERROR));
        }
        
        return $chart;

    }




}
