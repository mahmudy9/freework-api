@extends('admin.dashboard')

@section('content')
<div class="container">

<div class="row justify-content-center">
<div class="col-8">
<h2>Workers List</h2>
<table class="table">
<tr>
<td>#</td>
<td>Worker Name</td>
<td>Worker Address</td>
<td>Worker Phone</td>
<td>Worker City</td>
</tr>
@php
$num =1;
@endphp
@foreach($workers as $worker)
    <tr>
        <td>{{$num}}</td>
        <td>{{$worker->name}}</td>
        <td>{{$worker->address}}</td>
        <td>{{$worker->phone}}</td>
        <td>{{$worker->city}}</td>
    </tr>
    @php
        $num++;
    @endphp
@endforeach
</table>
{{$workers->links('paginator')}}
</div>
</div>


</div>


@endsection