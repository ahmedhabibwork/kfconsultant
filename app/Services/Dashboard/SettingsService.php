<?php
namespace App\Services\Dashboard;
 use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Http\Requests\Dashboard\Client\ClientRequest;
use App\Http\Requests\Dashboard\Settings\SettingsRequest;
use App\Models\Category;
use App\Models\Client ;
use App\Models\Settings;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class SettingsService
{

   
    public function edit($id)
    {       

        $edit=Settings::find($id);
         return view('dashboard.settings.edit',compact('edit'));
    }
    public function update(SettingsRequest $request, $id)
    {
          $request['is_default']=1; 
        Settings::find($id)->update($request->all());
         return redirect()->back()->with(['message' => '  Update Settings Sucesses  ', 'alert' => 'alert-success']);

    }


 
}
