<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request as Req;
use App\User;
use App\Role;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api' , 'Company'])->except(['store_register']);
    }


    public function store_register(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'email|required|unique:users,email',
            'name' => 'required|min:3|max:100',
            'password' => 'required|min:6|max:100',
            'c_password' => 'required|same:password',
            'address' => 'required|min:8|max:200',
            'city' => 'required|min:5|max:100',
            'phone' => 'required|min:9|max:100'
        ]);
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()] , 400);
        }
        $role_company = Role::where('name' , 'company')->first();
        $company = new User;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->password = Hash::make($request->input('password'));
        $company->address = $request->input('address');
        $company->phone = $request->input('phone');
        $company->city = $request->input('city');
        $company->save();
        $company->roles()->attach($role_company);
        $success['token'] = $company->createToken('freework')->accessToken;
        $success['name'] = $company->name;
        return response()->json(['success' => $success] , 200);
    }



    public function request_job($id)
    {
        if(Req::where([ 'job_id' => $id , 'freelancer_id' => Auth::id()])->exists())
        {
            return response()->json(['error' => 'You already requested for this job'] , 400);
        }
        $request = new Req;
        $request->freelancer_id = Auth::id();
        $request->job_id = $id;
        $request->save();
        return response()->json(['request' => $request] , 200);
    }


    public function my_requests()
    {
        $requests = Req::where(['freelancer_id' => Auth::id() , 'status' => 0])->paginate(15);
        return response()->json(['requests' => $requests] , 200);
    }


    public function accepted_requests()
    {
        $requests = Req::where(['freelancer_id' => Auth::id() , 'status' => 1])->paginate(15);
        return response()->json(['requests' => $requests] , 200);
    }


    public function refused_requests()
    {
        $requests = Req::where(['freelancer_id' => Auth::id() , 'status' => 2])->paginate(15);
        return response()->json(['requests' => $requests] , 200);
    }


    public function cancel_request($id)
    {
        $request = Req::where(['freelancer_id' => Auth::id() , 'job_id' => $id])->first();
        if($request->status == 1 || $request->status == 2)
        {
            return response()->json(['error' => 'cant delete request'] , 400);
        }

        $request->delete();
        return response()->json(['message' => 'request deleted'] , 200);
    }


    public function edit_profile()
    {
        $company = User::find(Auth::id());
        return response()->json(['company' => $company] , 200);
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'email|required|unique:users,email',
            'name' => 'required|min:3',
            'address' => 'required|min:8',
            'city' => 'required|min:5',
            'phone' => 'required|min:9|numeric'
        ]);
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()] , 400);
        }
        $company = User::find(Auth::id());
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->address = $request->input('address');
        $company->phone = $request->input('phone');
        $company->city = $request->input('city');
        $company->save();
        return response()->json(['company' => $company] , 200);

    }

}
