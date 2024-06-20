<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Responses\ServerResponse;
use App\Services\AuthorService;
use Illuminate\Http\Request;

use function App\Helpers\success;

class AuthorController extends Controller
{

    protected AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {

        $this->authorService = $authorService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->authorService->getAuthorAll();
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
        $data = $request->only('name', 'author_id', 'slug');
        $response = $this->authorService->createAuthor($data);
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
        $response = $this->authorService->getAuthorById($id);
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
        $data = $request->only('name', 'author_id', 'slug');
        $response = $this->authorService->updateAuthorById($id, $data);
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
        $response = $this->authorService->deleteAuthorById($id);
        return success(ServerResponse::SUCCESS_DELETE, $response);  
    }
}
