<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Responses\ServerResponse;
use Illuminate\Http\Request;
use App\Services\UserService;
use function App\Helpers\success;

class UserController extends Controller
{
    
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->userService->getUserAll();
        return success(ServerResponse::SUCCESS, $response);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->userService->getUserById($id);
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
        $data = $request->only('name', 'email', 'password', 'role_id');
        $response = $this->userService->updateUserById($id, $data);
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
        $response = $this->userService->deleteUserById($id);
        return success(ServerResponse::SUCCESS_DELETE, $response);  
    }
}
