<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Responses\ServerResponse;
use App\Services\RoleService;
use Illuminate\Http\Request;

use function App\Helpers\success;

class RoleController extends Controller
{

    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {

        $this->roleService = $roleService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->roleService->getRoleAll();
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
        $data = $request->only('name');
        $response = $this->roleService->createRole($data);
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
        $response = $this->roleService->getRoleById($id);
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
        $data = $request->only('name');
        $response = $this->roleService->updateRoleById($id, $data);
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
        $response = $this->roleService->deleteRoleById($id);
        return success(ServerResponse::SUCCESS_DELETE, $response);  
    }
}
