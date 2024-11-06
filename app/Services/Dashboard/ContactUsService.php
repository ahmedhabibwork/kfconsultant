<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Category\CategoryRequest;

use App\Models\Category;
use App\Models\ContactUs;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;
class ContactUsService
{

    public function index()
    {

               
        try {
            $contacts = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                ContactUs::orderBy('id','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.contactus.list', [
                'contacts' => $contacts
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
       public function delete_item($id)
    {
      
        $item=ContactUs::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.contact-us.index')->with('message', 'item deleted!');
        }  
    }
    
 
}
