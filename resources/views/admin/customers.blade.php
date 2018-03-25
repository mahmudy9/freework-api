@extends('admin.dashboard')

@section('content')
<div class="container">

<div class="row justify-content-center">
<div class="col-8">
<h2>customers List</h2>
<table class="table">
<tr>
<td>#</td>
<td>Customer Name</td>
<td>Customer Address</td>
<td>Customer Phone</td>
<td>Customer City</td>
</tr>
@php
$num =1;
@endphp
@foreach($customers as $customer)
    <tr>
        <td>{{$num}}</td>
        <td>{{$customer->name}}</td>
        <td>{{$customer->address}}</td>
        <td>{{$customer->phone}}</td>
        <td>{{$customer->city}}</td>
    </tr>
    @php
        $num++;
    @endphp
@endforeach
</table>
{{$customers->links('paginator')}}
</div>
</div>


</div>


@endsection