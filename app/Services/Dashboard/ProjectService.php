<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Project\CreateProjectRequest;
 use App\Http\Requests\Dashboard\Project\UpdateProjectRequest;
use App\Models\Category ;
use App\Models\Project;
use App\Models\ProjectImages;
use App\Models\Scale;
use App\Models\Scope;
use App\Models\Status;
use App\Models\Year;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class ProjectService
{

    public function index()
    {
        try {
            $projects = 
            //Cache::remember('projects', 60, function () {
             //   return 
                
                Project::orderBy('sort_order','asc')->paginate(20);
         //   });
      
            return  Response::view('dashboard.projects.list', [
                'projects' => $projects
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }
    }
    public function create()
    {       
        $categories=Category::where('is_active',1)->orderBy('sort_order','asc')->get();
        $scales=Scale::where('is_active',1)->orderBy('sort_order','asc')->get();
        $scopes=Scope::where('is_active',1)->orderBy('sort_order','asc')->get();
        $years=Year::where('is_active',1)->orderBy('sort_order','asc')->get();
        $status=Status::where('is_active',1)->orderBy('sort_order','asc')->get();
        return view('dashboard.projects.create',get_defined_vars());
    }
    public function store(CreateProjectRequest $request)
    {
   
      
        if (empty($request->is_active)) {
        
            $request['is_active']=0;
           
        }
        if (empty($request->sort_order)) 
        {
           $lastItem=Category::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }
    
        $project=   Project::create($request->all());
       if($request->hasfile('input_img')&&  isset($project->id) && !empty($project->id) ) {
        $count=1;
     foreach ($request->file('input_img') as $file) {

          
        $name =time() . '.' . $file->getClientOriginalName();
        $destinationPath = public_path('/app-assets/images/Project');
        $file->move($destinationPath, $name);
            $fileModal = new ProjectImages();
            $fileModal->project_id =$project->id;
            $fileModal->image = $name;
            $fileModal->sort_order = $count;
            $fileModal->save();
            $count++;
        }
    }
        return redirect()->route('dashboard.projects.index')->with(['message' => 'Create Project Sucesses  ', 'alert' => 'alert-success']);


    }

    public function edit($id)
    {       
        $edit=Project::find($id);

        $categories=Category::where('is_active',1)->orderBy('sort_order','asc')->get();
        $scales=Scale::where('is_active',1)->orderBy('sort_order','asc')->get();
        $scopes=Scope::where('is_active',1)->orderBy('sort_order','asc')->get();
        $years=Year::where('is_active',1)->orderBy('sort_order','asc')->get();
        $status=Status::where('is_active',1)->orderBy('sort_order','asc')->get();
        return view('dashboard.projects.edit',get_defined_vars());
    }
    public function update(UpdateProjectRequest $request, $id)
    {


        if (!empty($request->is_active)) {
            $request['is_active']=$request->is_active;
        }else 
        {
            $request['is_active']=0;  
        }
        if (empty($request->sort_order)) 
        {
           $lastItem=Category::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }
    
        $project=  Project::find($id)->fill($request->all())->update($request->all());
 
        if($request->hasfile('input_img') ) {
         
            $count=1;
          $countProjecctImages= ProjectImages::where('project_id',$id)->count();
 
           if(isset($countProjecctImages)&&!empty($countProjecctImages))
           {
             $count=$countProjecctImages + 1;
           }
        
            foreach ($request->file('input_img') as $file) {
    
                $name =time() . '.' . $file->getClientOriginalName();
                $destinationPath = public_path('/app-assets/images/Project');
                $file->move($destinationPath, $name);
                $fileModal = new ProjectImages();
                $fileModal->project_id =$id;
                $fileModal->image = $name;
                $fileModal->sort_order = $count;
                $fileModal->save();
                $count++;
            }
        }
        return redirect()->route('dashboard.projects.index')->with(['message' => '  Update Project Sucesses  ', 'alert' => 'alert-success']);

    }


    public function delete_item($id)
    {
      
        $item=Project::find($id);
        if(isset($item) && !empty($item))
        {
            $item->delete();
  
            return redirect()->route('dashboard.projects.index')->with('message', 'item deleted!');
        }
     
   
        
    }
    public function delete_image($id)
    {
        $item=ProjectImages::where(['id'=>$id]);
        if(isset($item) && !empty($item))
        {
           $item->delete();
            return redirect()->back()->with('message', 'image deleted!');
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
        $model =Project::find($id);
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
