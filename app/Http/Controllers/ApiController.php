<?php

namespace App\Http\Controllers;

use App\Api;
use App\Http\Requests\ApiRequest as Request;
use App\User;

class ApiController extends Controller
{

    public function index()
    {
        $user = session('user','');
        $apis = $user->apis()->get();

        return view('index',compact('apis'));
    }



    public function store(Request $request)
    {
        $api = new Api([
            'entry'=> $request->get('entry'),
            'method'=> $request->get('method'),
            'data'=> $request->get('data')
        ]);

        $user = session('user');
        $api->user()->associate($user);
        $api->save();

        return  redirect()->route('api.index');
    }



    public function update(Request $request, $id)
    {
        $api = Api::find($id);
        $api->update($request->all());

        return  redirect()->route('index');
    }


    public function destroy($id)
    {
        $api = Api::find($id);
        $api->delete();

        return  redirect()->route('index');
    }

    public function go(\Illuminate\Http\Request $request,$github_id) {
        $path = $request->path();
        $path = explode('/',$path);
        array_shift($path);
        $entry = implode('/', $path);
        $user = User::where('github_id',$github_id)->first();
        $api = $user->apis()->where('entry',$entry)->first();

        return $api->data;
    }

}
