<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Career\CareerRequest;
use App\Models\Category;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Http\Requests\Dashboard\Client\ClientRequest;
use App\Services\Dashboard\CareerService;
use App\Services\Dashboard\CategoryService;
use App\Services\Dashboard\ClientService;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public $service;

    public function __construct(CareerService $service)
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
    public function store(CareerRequest $request)
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
    public function update(CareerRequest $request,  $id)
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
    public function change_status($id)
    {
       $this->service->change_status($id);   
    }
}
