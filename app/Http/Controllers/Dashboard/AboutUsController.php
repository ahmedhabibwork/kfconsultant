<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutUs\AboutUsRequest;
use App\Services\Dashboard\AboutUsService;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public $service;

    public function __construct(AboutUsService $service)
    {
        $this->service = $service;
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
    public function update(AboutUsRequest $request,  $id)
    {
        return   $this->service->update($request,$id);
    }

    
}
