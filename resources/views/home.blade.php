@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
        @foreach($jobs as $job)
            <div class="card mb-3">
                <img class="card-img-top" width="300px" height="200px" src="{{asset('storage/storage/img/'.$job->image)}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$job->title}}</h5>
                    <p class="card-text">{{substr($job->description, 0 ,150)}}</p>
                    <p class="card-text"><small>Customer:<a href="{{url('user/'.$job->user->id)}}" >{{$job->user->name}}</a></small>
                    <p>Phone: {{$job->phone}}</p>
                    <p class="card-text"><small class="text-muted">{{$job->created_at}}</small></p>
                    <a href="{{url('jobdetails/'.$job->id)}}" class="btn btn-primary" >Job Details</a>
                </div>
            </div>
        @endforeach
        {{$jobs->links('paginator')}}
        </div>
    </div>
</div>
@endsection
