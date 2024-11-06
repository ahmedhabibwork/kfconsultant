<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Service\ServiceRequest;
use App\Http\Requests\Dashboard\SubService\SubServiceRequest;
use App\Models\Service;
use App\Models\SubService;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;
class SubServiceService
{

    public function index()
    {

               
        try {
            $subServices = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
             SubService::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.sub-services.list', [
                'subServices' => $subServices
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        $services=Service::where('is_active',1)->orderBy('sort_order','asc')->get();
        return view('dashboard.sub-services.create',compact('services'));  
    }
    public function store(SubServiceRequest $request)
    {
       
         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=SubService::get()->last();
     
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
       SubService::create($request->all());
         return redirect()->route('dashboard.sub-services.index')->with(['message' => 'Create Sub Service Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
        $services=Service::where('is_active',1)->orderBy('sort_order','asc')->get();
        $edit=SubService::find($id);
         return view('dashboard.sub-services.edit',compact('edit','services'));
    }
    public function update(SubServiceRequest $request, $id)
    {

      
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        
        if (empty($request->sort_order)) 
        {
           $lastItem=SubService::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        SubService::find($id)->update($request->all());
         return redirect()->route('dashboard.sub-services.index')->with(['message' => '  Update Sub Service Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=SubService::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.sub-services.index')->with('message', 'item deleted!');
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
        $model =SubService::find($id);
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
