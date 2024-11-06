<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Http\Requests\Dashboard\Client\ClientRequest;
use App\Http\Requests\Dashboard\Settings\SettingsRequest;
use App\Services\Dashboard\CategoryService;
use App\Services\Dashboard\ClientService;
use App\Services\Dashboard\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public $service;

    public function __construct(SettingsService $service)
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
    public function update(SettingsRequest $request,  $id)
    {
        return   $this->service->update($request,$id);
    }

}
