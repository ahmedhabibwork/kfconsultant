<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Project\CreateProjectRequest;
use App\Http\Requests\Dashboard\Property\CreatePropertyRequest;
use App\Http\Requests\Dashboard\Property\UpdatePropertyRequest;
use App\Models\Scale;
use App\Models\Scope;
use App\Models\Status;
use App\Models\Year;
use Exception;
use App\Services\Dashboard\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PropertyController extends Controller
{
    public $service;


    public function __construct(PropertyService $service )
    {
       return $this->service = $service;

 
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
    public function store(CreatePropertyRequest $request)
    {
        return  $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return  $this->service->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, string $id)
    {
        return   $this->service->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete_item( $id)
    {
 
       return $this->service->delete_item($id);  
    }
    public function change_status($id)
    {
       $this->service->change_status($id);   
    }
}
