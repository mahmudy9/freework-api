<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Job;
use App\Request as Req;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth' , 'Customer']);
    }



    public function register()
    {
        return view('customer.register');
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
        $role_customer = Role::where('name' , 'customer')->first();
        $customer = new User;
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = Hash::make($request->input('password'));
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');
        $customer->city = $request->input('city');
        $customer->save();
        $customer->roles()->attach($role_customer);
        $request->session()->flash('status' , 'You are now registered, You may now sign in');
        return redirect()->back();
    }


    public function add_job()
    {
        return view('customer.addjob');
    }


    public function store_job(Request $request)
    {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('public/storage/img');
            
            $file = pathinfo( $path , PATHINFO_BASENAME );
        }

        $validator = Validator::make($request->all() , [
            'title' => 'required|min:5|max:255',
            'image' => 'required|image|max:1999',
            'description' => 'required|min:10|max:1000',
            'phone' => 'required|numeric|min:9'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $job = new Job;
        $job->user_id = Auth::id();
        $job->title = $request->input('title');
        $job->image = $file;
        $job->description = $request->input('description');
        $job->phone = $request->input('phone');
        $job->save();
        $request->session()->flash('status' , 'Job created and you can edit or delete job');
        return redirect()->back();
    }


    public function delete_job($id)
    {
        $job = Job::find($id);
        if($job->user_id != Auth::id())
        {
            return response()->json([] , 400);
        }

        $requests = Req::where('job_id' , $job->id);
        $reqs = $requests->get(['status']);
        foreach($reqs as $req)
        {
            if($req->status == 1)
            {
                return response()->json([] , 400);
 
            }
        }
        $job->delete();
        $requests->delete();
        return response()->json([] , 200);
    }

    public function edit_job($id)
    {
        $job = Job::find($id);
    
        if($job->user_id != Auth::id())
        {
            return abort(404);
        }
        return view('customer.editjob' , compact('job'));
    }

    public function update_job(Request $request)
    {
        $job = Job::find($request->input('id'));
        if($job->user_id != Auth::id())
        {
            return abort(404);
        }

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('public/img');
            $file = pathinfo($path , PATHINFO_BASENAME);
        }

        $validator = Validator::make($request->all() , [
            'title' => 'required|min:5|max:255',
            'image' => 'image|max:1999',
            'description' => 'required|min:10|max:1000',
            'phone' => 'required|numeric|min:9'
        ]);

        if($validator->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validator);
        }

        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->phone = $request->input('phone');
        if(isset($file))
        {
            $job->image = $file;
        }
        $job->save();
        $request->session()->flash('status' , 'Job Has Been Updated');
        return redirect()->back();
    }


    public function accept_request($id)
    {
        $req = Req::find($id);
        $job_id = $req->job_id;
        $job = Job::find($job_id);
        if($job->user_id != Auth::id())
        {
            return abort(404);
        }
        //status = 1 means accepted
        $req->status = 1;
        $req->save();
        return redirect()->back();
    }


    public function refuse_request($id)
    {
        $req = Req::find($id);
        $job_id = $req->job_id;
        $job = Job::find($job_id);
        if($job->user_id != Auth::id())
        {
            return response()->json([] , 404);
        }
        //status = 2 means its refused
        $req->status = 2;
        $req->save();
        return response()->json([] , 200);

    }


    public function undo_request($id)
    {
        $request = Req::find($id);
        $job_id = $request->job_id;
        $job = Job::find($job_id);
        if($job->user_id != Auth::id())
        {
            return abort(404);
        }
        $request->status = 2;
        $request->save();
        return redirect()->back();
    }


    public function myjobs()
    {
        $jobs = Job::where('user_id' , Auth::id())->latest()->paginate(10);
        return view('customer.myjobs' , compact('jobs'));
    }


    public function job($id)
    {
        
        $job = Job::find($id);
        if($job->user_id != Auth::id())
        {
            return abort(404);
        }

        if(Req::where(['job_id' => $id , 'status' => 1 ])->exists())
        {
            $res = 0;
            $req = Req::where(['job_id' => $id , 'status' => 1])->first();
        }
        else
        {
            $res = 1;
        }
        $requests = Req::where(['job_id' => $id , 'status' => 0 ])->paginate('10');

        return view('customer.job' , compact('job' , 'requests' , 'req' ,'res'));
    }


    public function job_requests($id)
    {
        $job = Job::find($id);
        if($job->user_id != Auth::id())
        {
            return abort(404);
        }

        $requests = Req::where('job_id' , $id)->get();
        return view('customer.jobrequests' , compact('requests'));
    }


        public function edit_profile()
    {
        $customer = User::find(Auth::id());
        return view('customer.editprofile' , compact('customer'));
    }

    public function update_profile(Request $request )
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
        $customer = User::find(Auth::id());
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');
        $customer->city = $request->input('city');
        $customer->save();
        $request->session()->flash('status' , 'your data has been updated');
        return redirect()->back();

    }
 
    


    
}
