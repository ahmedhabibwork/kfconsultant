<?php
namespace App\Services\Dashboard;
use App\Http\Requests\Dashboard\News\CreateNewsRequest;
use App\Http\Requests\Dashboard\News\UpdateNewsRequest;
use App\Models\Category;
use App\Models\Client ;
use App\Models\News;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class NewsService
{

    public function index()
    {

               
        try {
            $news = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                 News::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.news.list', [
                'news' => $news
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        return view('dashboard.news.create');  
    }
    public function store(CreateNewsRequest $request)
    {
     
     
        if ($request->hasFile('input_img')) {
      
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/app-assets/images/News');
            $image->move($destinationPath, $name);
            $request['image']= $name;
        }
        if (empty($request->status)) 
        $request['status']="";
 
         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=News::get()->last();
     
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
       News::create($request->all());
         return redirect()->route('dashboard.news.index')->with(['message' => 'Create News Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=News::find($id);
         return view('dashboard.news.edit',compact('edit'));
    }
    public function update(UpdateNewsRequest $request, $id)
    {
   
        if ($request->hasFile('input_img')) {
      
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/app-assets/images/News');
            $image->move($destinationPath, $name);
            $request['image']=$name;
        }
      
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }

        if (empty($request->status)) 
        {
            $request['status']="";
        }
        
        if (empty($request->sort_order)) 
        {
           $lastItem=News::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        News::find($id)->update($request->all());
         return redirect()->route('dashboard.news.index')->with(['message' => '  Update News Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=News::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.news.index')->with('message', 'item deleted!');
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
        $model = News::find($id);
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
