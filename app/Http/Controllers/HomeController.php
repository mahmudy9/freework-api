<?php

namespace App\Http\Controllers;
use App\Job;
use App\Request as Req;
use App\User;
use Validator;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function home()
    {
        return view('layouts.app');
    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => request('email') ,  'password' => request('password')]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('freework')->accessToken;
            return response()->json(['success' => $success] , 200);
        }

        return response()->json(['error' => 'Failed To Login'] , 401);

    }


    protected function guard()
    {
        return Auth::guard('api');
    }


    public function logout(Request $request)
    {
        if(!$this->guard()->check())
        {
            return response()->json(['message' => 'No user session was found'] , 404);
        }

        $request->user('api')->token()->revoke();

        Auth::guard()->logout();

        Session::flush();

        Session::regenerate();

        return response()->json(['message' => 'User Logged Out Successfully'] , 200);
        
    }



    public function index()
    {
        $jobs = Job::where('approved' , 1)->paginate(10);
        return response()->json(['jobs' => $jobs] , 200);
    }


    public function job_details($id)
    {

        $job = Job::find($id);

        if($job->approved != 1)
        {
            return response()->json(['error' => 'unauthorized'] , 401);
        }

        if(Req::where(['freelancer_id' => Auth::id() , 'job_id' => $id , 'status' => 0 ])->exists() || Req::where(['freelancer_id' => Auth::id() , 'job_id' => $id , 'status' => 2 ])->exists())
        {
            $button = 0;
        }
        else
        {
            $button = 1;
        }

        if(Req::where(['job_id' => $id , 'status' => 1])->exists())
        {
            $jobclosed = 1;
        }
        else
        {
            $jobclosed = 0;
        }

        if(Req::where(['job_id' => $id ,'freelancer_id' => Auth::id(), 'status' => 1])->exists())
        {
            $yourjob = 1;
        }
        else
        {
            $yourjob = 0;
        }


        return response()->json(['job' => $job , 'button' => $button , 'jobclosed' => $jobclosed , 'yourjob' => $yourjob] , 200);
    }



    public function userdetails($id)
    {
        $user = User::find($id);
        if($user->hasRole('admin'))
        {
            return response()->json(['error' => 'unauthorized'] , 401);
        }
        return response()->json(['user' => $user] , 200);
    }




    public function store_contact(Request $request)
    {
        if(Auth::user())
        {
            $validator = Validator::make($request->all() , [
                'body' => 'required|min:10'
            ]);
        }
        else
        {
            $validator = Validator::make($request->all() , [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'body' => 'required|min:10'
            ]);
        }

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()] , 400);
        }

        if(Auth::user())
        {
            $contact = new Contact;
            $contact->user_id = Auth::id();
            $contact->name = Auth::user()->name;
            $contact->email = Auth::user()->email;
            $contact->body = $request->input('body');
            $contact->save();
        }
        else
        {
            $contact = new Contact;
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->body = $request->input('body');
            $contact->save();
        }

        return response()->json(['message' => 'contact created'] , 200);
    }


}
