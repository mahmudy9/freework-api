@extends('admin.dashboard')

@section('content')
<div class="container">

<div class="row justify-content-center">
<div class="col-8">
<h2>Companies List</h2>
<table class="table">
<tr>
<td>#</td>
<td>Company Name</td>
<td>Company Address</td>
<td>Company Phone</td>
<td>Company City</td>
</tr>
@php
$num =1;
@endphp
@foreach($companies as $company)
    <tr>
        <td>{{$num}}</td>
        <td>{{$company->name}}</td>
        <td>{{$company->address}}</td>
        <td>{{$company->phone}}</td>
        <td>{{$company->city}}</td>
    </tr>
    @php
        $num++;
    @endphp
@endforeach
</table>
{{$companies->links('paginator')}}
</div>
</div>


</div>


@endsection