@extends('admin.dashboard')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-4">
<h2>{{$job->title}}</h2>
<img src="{{asset('storage/storage/img/'.$job->image)}}" width="200px" height="350px" >
</div>
<div class="col-4">
<h3>Description</h3>
<p>{{$job->description}}</p>
</div>
<div class="col-4">
<h3>Details</h3>
@if($job->approved == 1)
<p>Approved</p>
@else
<p>Not Approved</p>
@endif

<p>Customer: <a href="{{url('user/'.$job->user->id)}}" >{{$job->user->name}}</a></p>
<p>{{$job->phone}}</p>
<p><small>{{$job->created_at}}</small></p>
</div>
@endsection