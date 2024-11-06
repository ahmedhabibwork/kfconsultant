<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Category\CategoryRequest;
 use App\Http\Requests\Dashboard\Client\CreateClientRequest;
use App\Http\Requests\Dashboard\Client\UpdateClientRequest;
use App\Models\Category;
use App\Models\Client ;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class ClientService
{

    public function index()
    {

               
        try {
            $clients = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                 Client::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.clients.list', [
                'clients' => $clients
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        return view('dashboard.clients.create');  
    }
    public function store(CreateClientRequest $request)
    {
     
        if ($request->hasFile('input_img')) {
      
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/app-assets/images/Client');
            $image->move($destinationPath, $name);
            $request['image']=$name;
        }
       
         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=Client::get()->last();
     
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
       Client::create($request->all());
         return redirect()->route('dashboard.clients.index')->with(['message' => 'Create Client Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=Client::find($id);
         return view('dashboard.clients.edit',compact('edit'));
    }
    public function update(UpdateClientRequest $request, $id)
    {
   
        if ($request->hasFile('input_img')) {
      
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/app-assets/images/Client');
            $image->move($destinationPath, $name);
            $request['image']=$name;
        }
      
        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        
        if (empty($request->sort_order)) 
        {
           $lastItem=Client::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        Client::find($id)->update($request->all());
         return redirect()->route('dashboard.clients.index')->with(['message' => '  Update Client Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=Client::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.clients.index')->with('message', 'item deleted!');
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
        $model = Client::find($id);
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
