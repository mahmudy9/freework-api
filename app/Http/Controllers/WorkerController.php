<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Validator;
use App\Request as Req;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' , 'Worker']);
    }



    public function register()
    {
        return view('worker.register');
    }



    public function store_register(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'email|required|unique:users,email',
            'name' => 'required|min:3|max:100',
            'password' => 'required|min:6|max:100|confirmed',
            'address' => 'required|min:8|max:200',
            'city' => 'required|min:5|max:100',
            'phone' => 'required|min:9|max:100|numeric'
        ]);
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
        $role_worker = Role::where('name' , 'worker')->first();
        $worker = new User;
        $worker->name = $request->input('name');
        $worker->email = $request->input('email');
        $worker->password = Hash::make($request->input('password'));
        $worker->address = $request->input('address');
        $worker->phone = $request->input('phone');
        $worker->city = $request->input('city');
        $worker->save();
        $worker->roles()->attach($role_worker);
        $request->session()->flash('status' , 'You are now registered, You may now sign in');
        return redirect()->back();
    }




    public function request_job($id)
    {
        if(Req::where([ 'job_id' => $id , 'freelancer_id' => Auth::id()])->exists())
        {
            return response()->json([] , 400);
        }
        $request = new Req;
        $request->freelancer_id = Auth::id();
        $request->job_id = $id;
        $request->save();
        return response()->json([] , 200);
    }


    public function my_requests()
    {
        $requests = Req::where(['freelancer_id' => Auth::id() , 'status' => 0])->paginate(15);
        return view('worker.myrequests' , compact('requests'));
    }


    public function accepted_requests()
    {
        $requests = Req::where(['freelancer_id' => Auth::id() , 'status' => 1])->paginate(15);
        return view('worker.acceptedrequests' , compact('requests'));
    }


    public function refused_requests()
    {
        $requests = Req::where(['freelancer_id' => Auth::id() , 'status' => 2])->paginate(15);
        return view('worker.refusedrequests' , compact('requests'));
    }


    public function cancel_request($id)
    {
        $request = Req::where(['freelancer_id' => Auth::id() , 'job_id' => $id])->first();
        if($request->status == 1 || $request->status == 2)
        {
            return response()->json([] , 404);
        }

        $request->delete();
        return response()->json(['request deleted'] , 200);
    }


    public function edit_profile()
    {
        $worker = User::find(Auth::id());
        return view('worker.editprofile' , compact('worker'));
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all() , 
        [
            'email' => 'email|required|unique:users,email',
            'name' => 'required|min:3',
            'address' => 'required|min:8',
            'city' => 'required|min:5',
            'phone' => 'required|min:9|numeric'
        ]);
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }
        $worker = User::find(Auth::id());
        $worker->name = $request->input('name');
        $worker->email = $request->input('email');
        $worker->address = $request->input('address');
        $worker->phone = $request->input('phone');
        $worker->city = $request->input('city');
        $worker->save();
        $request->session()->flash('status' , 'your data has been updated');
        return redirect()->back();

    }



}
