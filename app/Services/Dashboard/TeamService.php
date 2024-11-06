<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Http\Requests\Dashboard\Client\ClientRequest;
use App\Http\Requests\Dashboard\Team\TeamRequest;
use App\Models\Category;
use App\Models\Client ;
use App\Models\Team;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class TeamService
{

    public function index()
    {

               
        try {
            $teams = 
            //Cache::remember('banners', 60, function () {
             //   return 
                
                 Team::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.teams.list', [
                'teams' => $teams
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {
        return view('dashboard.teams.create');  
    }
    public function store(TeamRequest $request)
    {
     
        if ($request->hasFile('input_img')) {
      
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/app-assets/images/Team');
            $image->move($destinationPath, $name);
            $request['image']=$name;
        }
       
         if (empty($request->is_active)) 
             $request['is_active']=0;

      
         if (empty($request->sort_order)) 
         {
            $lastItem=Team::get()->last();
     
            if(isset($lastItem)&&!empty($lastItem))
            {
                $request['sort_order']=   $lastItem->sort_order + 1;
            }else
            $request['sort_order']=0;
         }
   
    
         Team::create($request->all());
         return redirect()->route('dashboard.teams.index')->with(['message' => 'Create Team Sucesses  ', 'alert' => 'alert-success']);
    }

    public function edit($id)
    {       
  
        $edit=Team::find($id);
         return view('dashboard.teams.edit',compact('edit'));
    }
    public function update(TeamRequest $request, $id)
    {
   
        if ($request->hasFile('input_img')) {
      
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/app-assets/images/Team');
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
           $lastItem=Team::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        Team::find($id)->update($request->all());
         return redirect()->route('dashboard.teams.index')->with(['message' => '  Update Team Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=Team::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.teams.index')->with('message', 'item deleted!');
        }
     
   
        
    }
    public function destroy($id)
    {
    dd($id);

    }
 
    public function change_status($id)
    {
        $model = Team::find($id);
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
