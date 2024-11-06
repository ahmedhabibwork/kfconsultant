<?php
namespace App\Services\Dashboard;
use App\Http\Requests\Dashboard\AboutUs\AboutUsRequest;

use App\Models\AboutUs;
use Modules\Product\Entities\Banner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;


class AboutUsService
{

       public function edit($id)
    {       
  
        $edit=AboutUs::find($id);
         return view('dashboard.about-us.edit',compact('edit'));
    }
    public function update(AboutUsRequest $request, $id)
    {
      

        if (empty($request->sort_order)) 
        {
           $lastItem=AboutUs::get()->last();
           if(isset($lastItem)&&!empty($lastItem))
           {
               $request['sort_order']=   $lastItem->sort_order  + 1;
           }else
           $request['sort_order']=0;
        }

        AboutUs::find($id)->update($request->all());
         return redirect()->back()->with(['message' => '  Update About Us Page Sucesses  ', 'alert' => 'alert-success']);

    }


 
}
