<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Responses\ServerResponse;
use App\Services\ChartService;
use Illuminate\Http\Request;

use function App\Helpers\success;

class ChartController extends Controller
{

    protected ChartService $chartService;

    public function __construct(ChartService $chartService)
    {

        $this->chartService = $chartService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->chartService->getChartAll();
        return success(ServerResponse::SUCCESS, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('book_id');
        $response = $this->chartService->createChart($data);
        return success(ServerResponse::SUCCESS_CREATE, $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->chartService->getChartById($id);
        return success(ServerResponse::SUCCESS, $response);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('book_id');
        $response = $this->chartService->updateChartById($id, $data);
        return success(ServerResponse::SUCCESS_UPDATE, $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->chartService->deleteChartById($id);
        return success(ServerResponse::SUCCESS_DELETE, $response);  
    }
}
