<?php
namespace App\Services\Dashboard;
use App\Http\Requests\Dashboard\Property\CreatePropertyRequest;
use App\Http\Requests\Dashboard\Property\UpdatePropertyRequest;
use App\Models\Category;
use App\Models\Scale;
use App\Models\Scope;
use App\Models\Status;
use App\Models\Year;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;
class PropertyService
{
    public $model;
    public $title;
    public $routeName;
    public function __construct()
    {

        try {
            $currentRoute =Route::currentRouteName();
            switch( $currentRoute)
            {
                case  str_contains($currentRoute, 'years'):
                    $this->title='Year';
                    $this->routeName='years';
                 return  $this->model= Year::class;
                break;
                case  str_contains($currentRoute, 'scopes'):
                    $this->title='Scope';
                    $this->routeName='scopes';
                    return  $this->model= Scope::class;
                break;
                case  str_contains($currentRoute, 'scales'):
                    $this->title='Scale';
                    $this->routeName='scales';
                    return  $this->model= Scale::class;
                break;
               case str_contains($currentRoute, 'status'):
                $this->title='Status';
                $this->routeName='status';
                  return  $this->model= Status::class;
                break;
                default:
                    
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }
    }
    public function index()
    {
  
        try {
            $properties = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
             $this->model::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.properties.list', [
                'properties' => $properties ,'title'=>$this->title ,'routeName'=>$this->routeName
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        $title=$this->title;
        $routeName=$this->routeName;
    return view('dashboard.properties.create',compact('title','routeName')); 
    } 
    public function store(CreatePropertyRequest $request)
    {

         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=$this->model::get()->last();
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
         $this->model::create($request->all());
         
         return redirect()->route('dashboard.'.$this->routeName.'.index')->with(['message' => 'Create '.$this->title.' Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=$this->model::find($id);
        $title=$this->title;
        $routeName=$this->routeName;
         return view('dashboard.properties.edit',compact('edit','title','routeName'));
    }
    public function update(UpdatePropertyRequest $request, $id)
    {

      
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        
        if (empty($request->sort_order)) 
        {
           $lastItem=$this->model::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order + 1;
           }else
           $request['sort_order']=0;
        }
        $this->model::find($id)->update($request->all());
   
         return redirect()->route('dashboard.'.$this->routeName.'.index')->with(['message' => '  Update '.$this->title.'Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {


        $item=$this->model::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.'.$this->routeName.'.index')->with('message', 'item deleted!');
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
 
        $model = $this->model::find($id);
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
