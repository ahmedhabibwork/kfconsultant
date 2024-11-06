<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Services\Dashboard\ContactUsService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public $service;

    public function __construct(ContactUsService $service)
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


    public function delete_item( $id)
    {
       return $this->service->delete_item($id);  
    }
}
