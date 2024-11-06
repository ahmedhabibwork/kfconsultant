<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Category;
use App\Models\Client;
use App\Models\ContactUs;
use App\Models\News;
use App\Models\Project;
use App\Services\Dashboard\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\Status;

class DashboardController extends Controller
{
    public function index ()
    {
        try
        {
            $categoryCount=Category::get()->count();
            $projectCount=Project::get()->count();
            $clientCount=Client::get()->count();
            $careersCount=Career::get()->count();
            $newsCount=News::get()->count();
            $contactusCount=ContactUs::get()->count();

            return  Response::view('dashboard.dashboard',get_defined_vars());
        }
        catch (Exception $exception) {
                dd($exception->getMessage());
              return redirect()->route('dashboard.error-page')->with('errors', 'Something Went Wrong');
    }
    }
    public function error_page ()
    {
        return view('dashboard.erorr_page');
    }
}
