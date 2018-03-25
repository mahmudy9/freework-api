<?php

namespace App\Http\Controllers;
use App\Job;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Request as Req;
use App\Role;
use Illuminate\Http\Request;
use App\Contact;
use Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' , 'Admin']);
    }

    public function index()
    {
        return view('admin.index');
    }


    public function approve_jobs()
    {
        $jobs = Job::where(['approved' => 0 , 'seen' => 0 ])->paginate(10);
        return view('admin.jobstoapprove' , compact('jobs'));
    }


    public function approve_job($id)
    {
        $job = Job::find($id);
        $job->approved = 1;
        $job->seen = 1;
        $job->save();
        return response()->json([] , 200);
    }


    public function disapprove_job($id)
    {
        $job = Job::find($id);
        $job->approved = 0;
        $job->seen = 1;
        $job->save();
        return response()->json([] , 200);
    }
    

    public function disapproved_jobs()
    {
        $jobs = Job::where('approved' , 0)->paginate(10);
        return view('admin.disapprovedjobs' ,compact('jobs'));
    }



    public function approved_jobs()
    {
        $jobs = Job::where('approved' , 1)->paginate(10);
        return view('admin.approvedjobs' ,compact('jobs'));
    }



    public function delete_job($id)
    {
        $job = Job::find($id);
        if($job->approved != 0)
        {
            return response()->json([] , 400);
        }
        $job->delete();
        return response()->json([] , 200);
    }


    public function customers()
    {
        $customers = Role::where('name' , 'customer')->first()->users()->paginate(15);
        //dd($customers);
        return view('admin.customers' , compact('customers'));
    }

    public function workers()
    {
        $workers = Role::where('name' , 'worker')->first()->users()->paginate(15);
        //dd($workers);
        return view('admin.workers' , compact('workers'));
    }

    public function companies()
    {
        $companies = Role::where('name' , 'company')->first()->users()->paginate(15);
        //dd($companies);
        return view('admin.companies' , compact('companies'));
    }

    public function requests()
    {
        $requests = Req::paginate(20);
        return view('admin.requests' , compact('requests'));
    }


    public function accepted_requests()
    {
        $requests = Req::where('status' , '1')->paginate(20);
        return view('admin.acceptedrequests' , compact('requests'));

    }



    public function edit_profile()
    {
        $admin = User::find(Auth::id());
        return view('admin.editprofile' , compact('admin'));
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
            return redirect()
            ->back()
            ->withErrors($validator);
        }
        $admin = User::find(Auth::id());
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->address = $request->input('address');
        $admin->phone = $request->input('phone');
        $admin->city = $request->input('city');
        $admin->save();
        $request->session()->flash('status' , 'your data has been updated');
        return redirect()->back();

    }


    public function job_details($id)
    {
        $job = Job::find($id);
        return view('admin.jobdetails' , compact('job'));
    }



    public function contacts()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts' , compact('contacts'));
    }





    public function change_password()
    {
        return view('admin.changepassword');
    }



    public function store_password(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'old_pass' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }
        $user = User::find(Auth::id());
        if(Hash::check($request->input('old_pass') , $user->password))
        {   
            $user->password = Hash::make($request->input('password'));
            $user->save();
            $request->session()->flash('status' , 'Password Changed');
            return redirect()->back();

        }
            $request->session()->flash('status' , 'Wrong Password');
            return redirect()->back();

    }



    public function delete_contact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return reponse()->json([] , 200);
    }


}

