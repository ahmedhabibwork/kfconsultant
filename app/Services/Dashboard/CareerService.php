<?php
namespace App\Services\Dashboard;

use App\Http\Requests\Dashboard\Career\CareerRequest;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Http\Requests\Dashboard\Client\ClientRequest;
use App\Models\Career;
use App\Models\Category;
use App\Models\Client ;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class CareerService
{

    public function index()
    {

               
        try {
            $careers = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                 Career::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.careers.list', [
                'careers' => $careers
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        return view('dashboard.careers.create');  
    }
    public function store(CareerRequest $request)
    {
     

         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=Career::get()->last();
     
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
         Career::create($request->all());
         return redirect()->route('dashboard.careers.index')->with(['message' => 'Create Career Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=Career::find($id);
         return view('dashboard.careers.edit',compact('edit'));
    }
    public function update(CareerRequest $request, $id)
    {
   
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        
        if (empty($request->sort_order)) 
        {
           $lastItem=Career::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        Career::find($id)->update($request->all());
         return redirect()->route('dashboard.careers.index')->with(['message' => '  Update Career Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=Career::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.careers.index')->with('message', 'item deleted!');
        }
     
   
        
    }
    public function destroy($id)
    {
    dd($id);
    }
 
    public function change_status($id)
    {
        $model = Career::find($id);
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
