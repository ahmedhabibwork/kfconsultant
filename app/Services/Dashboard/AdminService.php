<?php
namespace App\Services\Dashboard;

use App\Http\Requests\Dashboard\Admin\CreateAdminRequest;
use App\Http\Requests\Dashboard\Admin\UpdateAdminRequest;
use App\Models\User;
use App\Services\Dashboard\PermissionHelper;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;


class AdminService
{

    public function index()
    {
        try {
            $admins = 
            // Cache::remember('admins', 60, function () {
            //     return
                 User::orderByDesc('id')      
                              ->paginate(10);
            // });
      
            return  Response::view('dashboard.admins.list', [
                'admins' => $admins
            ]);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }

    }
    public function create()
    {

        return view('dashboard.admins.create');  
    }
    public function store(CreateAdminRequest $request)
    {

      
        if ($request->hasFile('input_img')) {
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Admin');
            $image->move($destinationPath, $name);
            $request['image']=$name;
           
        }
        if (isset( $request['password']) && !empty( $request['password']) ) {
            $request['password'] = Hash::make( $request['password']);
        }
        $request['is_active']=1; 
        $admin=  User::create($request->all());
   



      return redirect()->route('dashboard.admins.index')->with(['message' => ' Create Admin Sucesses ', 'alert' => 'alert-success']);

    }
    public function edit($id)
    {
        $edit=User::find($id);
        return view('dashboard.admins.edit',compact('edit'));
    
    }


    public function editProfile($id)
    {
        try {
            $edit=User::find($id);
            return view('dashboard.admins.profile',compact('edit'));
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return redirect('/')->with('errors', 'Something Went Wrong');
        }
  
    
    }
    public function updateProfile(UpdateAdminRequest $request, $id)
    {
        $admin=User::find($id);
        $old_password = $request['old_password'];

        if ($request->hasFile('input_img')) {
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Admin');
            $image->move($destinationPath, $name);
            $request['image']=$name;
        }

        if (Hash::check($old_password, $admin->password)) {
            if($old_password != $request['password'])
            {
          // The passwords match...
              if (isset( $request['password']) && !empty( $request['password']) ) 
               $request['password'] = Hash::make( $request['password']);
              else
              $request['password'] = $admin->password;
            }
            else
            {
                  // Old Password Is Same New Password...
                return redirect()->route('dashboard.profile.editProfile')->with(['error' => 'Old Password Is Same New Password ', 'alert' => 'alert-success']);
            }
  
        } else {
            // The passwords do not match...
            return redirect()->route('dashboard.profile.editProfile')->with(['error' => 'Old Password Incorrect ', 'alert' => 'alert-success']);
        }


             // Update Admin Sucesses...

        return redirect()->route('dashboard.profile.editProfile')->with(['message' => 'Update Admin Sucesses', 'alert' => 'alert-success']);

    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $admin=User::find($id);
        if ($request->hasFile('input_img')) {
            $image = $request->file('input_img');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Admin');
            $image->move($destinationPath, $name);
            $request['image']=$name;
        }
        if (isset( $request['password']) && !empty( $request['password']) ) 
            $request['password'] = Hash::make( $request['password']);
            else
            $request['password'] = $admin->password;
        
        User::find($id)->fill($request->all())->update($request->all());


        return redirect()->route('dashboard.admins.index')->with(['message' => 'Update Admin Sucesses', 'alert' => 'alert-success']);

    }


    public function destroy($id)
    {


    }
    public function delete_item($id)
    {
        $item=User::find($id);
        $item->delete();
 
        return redirect()->route('dashboard.admins.index')->with('message', 'successfully item deleted!');

    }

}
