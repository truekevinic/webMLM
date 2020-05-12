<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    public function read($user_id){

        $advertisements = Advertisement::where('user_id','=',Auth::user()->id)->get();

        return view('user.advertisement', compact(['advertisements', $advertisements]));
    }

    public function create(Request $request){

        $validateData =Validator::make($request->all(), [
            'link' => 'required',
            'description' => 'required',
            'image_source' => 'required|mimes:jpeg,jpg,png'
        ]);

        $advertisement = new Advertisement();

        $advertisement->user_id = Auth::user()->id;
        $advertisement->link = $request->link;
        $advertisement->description = $request->description;

        $picture_name = uniqid().$request->image_source->getClientOriginalName();
        $request->image_source->move(storage_path('app/public/images/'), $picture_name);

        $advertisement->image_source = $picture_name;
        $advertisement->save();

        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData->errors());
        }
        return redirect()->back()->withSuccess('Berhasil insert advertisement');
    }

    public function update(Request $request, $advertisement_id){
        $advertisement = Advertisement::find($advertisement_id);
        $advertisement->link = $request->link;
        $advertisement->description = $request->description;

        $advertisement->save();
        return redirect()->back();
    }

    public function delete($advertisement_id){
        Advertisement::destroy($advertisement_id);

        return redirect()->back();
    }
}
