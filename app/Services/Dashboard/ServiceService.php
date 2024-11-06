<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Service\ServiceRequest;

use App\Models\Category;
use App\Models\Service;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;
class ServiceService
{

    public function index()
    {

               
        try {
            $services = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                Service::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.services.list', [
                'services' => $services
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        return view('dashboard.services.create');  
    }
    public function store(ServiceRequest $request)
    {
       
         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=Service::get()->last();
     
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
       Service::create($request->all());
         return redirect()->route('dashboard.services.index')->with(['message' => 'Create Service Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=Service::find($id);
         return view('dashboard.services.edit',compact('edit'));
    }
    public function update(ServiceRequest $request, $id)
    {

      
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        
        if (empty($request->sort_order)) 
        {
           $lastItem=Service::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        Service::find($id)->update($request->all());
         return redirect()->route('dashboard.services.index')->with(['message' => '  Update Service Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=Service::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.services.index')->with('message', 'item deleted!');
        }
     
   
        
    }
    public function destroy($id)
    {
    dd($id);
        // $item=Category::find($category->id);
 
        // if(isset($item) && !empty($item))
        // {
        //     $item->deleted;
       
        //     return redirect()->route('dashboard.categories.index')->with('message', 'item deleted!');
        // }
        // return redirect()->route('dashboard.categories.index')->with('message', 'item deleted!');
    }
 
    public function change_status($id)
    {
        $model =Service::find($id);
        if(isset($model)&& !empty($model))
        {
         
        if ($model->is_active == 0)
        { $model->is_active = 1; }
        else
        {  $model->is_active = 0; }
        $model->save();
    
        return response()->json([
            'status' => 'success', 
            'message' => 'Information saved successfully!'
        ], 200);
     
        }
        else
        return 'Faild';

    }
 
}
