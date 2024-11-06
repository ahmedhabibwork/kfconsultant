<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Category\CategoryRequest;

use App\Models\Category;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;
class CategoryService
{

    public function index()
    {

               
        try {
            $categories = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                Category::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.categories.list', [
                'categories' => $categories
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        return view('dashboard.categories.create');  
    }
    public function store(CategoryRequest $request)
    {
       
         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastCategory=Category::get()->last();
     
            if(isset($lastCategory)&&!empty($lastCategory))
            {
                $request['sort_order']=   $lastCategory->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
       Category::create($request->all());
         return redirect()->route('dashboard.categories.index')->with(['message' => 'Create Category Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=Category::find($id);
         return view('dashboard.categories.edit',compact('edit'));
    }
    public function update(CategoryRequest $request, $id)
    {

      
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        
        if (empty($request->sort_order)) 
        {
           $lastCategory=Category::get()->last();
           if(isset($lastCategory)&&!empty($lastCategory))
           {
               $request['sort_order']=   $lastCategory->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        Category::find($id)->update($request->all());
         return redirect()->route('dashboard.categories.index')->with(['message' => '  Update Category Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=Category::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.categories.index')->with('message', 'item deleted!');
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
        $model = Category::find($id);
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
