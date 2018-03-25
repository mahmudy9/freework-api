@extends('admin.dashboard')

@section('content')
<div class="container">

<div class="row justify-content-center">
<div class="col-8">
<h2>Accepted Requests</h2>
<table class="table">
<tr>
<td>#</td>
<td>Freelancer Name</td>
<td>Job Title</td>
<td>Job Description</td>
<td>Status</td>
</tr>
@php
$num =1;
@endphp
@foreach($requests as $request)
    <tr>
        <td>{{$num}}</td>
        <td>{{$request->user->name}}</td>
        <td>{{$request->job->title}}</td>
        <td>{{substr($request->job->description , 0 ,150)}}</td>
        <td>
        Accepted
        </td>
    </tr>
    @php
        $num++;
    @endphp
@endforeach
</table>
{{$requests->links('paginator')}}
</div>
</div>


</div>


@endsection