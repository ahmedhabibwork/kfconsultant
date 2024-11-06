<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\Dashboard\Project\CreateProjectRequest;
use App\Http\Requests\Dashboard\Project\UpdateProjectRequest;
use App\Services\Dashboard\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->service->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  $this->service->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        return  $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return  $this->service->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request,  $id)
    {
        return   $this->service->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
    }
    public function delete_item( $id)
    {
       return $this->service->delete_item($id);  
    }
    
    public function delete_image($id)
    {
        return $this->service->delete_image($id); 
    }
    public function change_status($id)
    {
       $this->service->change_status($id);   
    }
}
