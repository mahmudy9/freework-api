@extends('admin.dashboard')

@section('content')
<div class="container">

<div class="row justify-content-center">
<div class="col-8">
<h2>Contacts List</h2>
<table class="table">
<tr>
<td>#</td>
<td>Contact Name</td>
<td>Contact Email Address</td>
<td>Message</td>
<td>Created At</td>
<td>Delete</td>
</tr>
@php
$num =1;
@endphp
@foreach($contacts as $contact)
    <tr id="{{$contact->id}}">
        <td>{{$num}}</td>
        <td>{{$contact->name}}</td>
        <td>{{$contact->email}}</td>
        <td>{{$contact->body}}</td>
        <td>{{$contact->created_at}}</td>
        <td><button class="btn btn-danger" onclick="delete_contact('{{url('admin/deletecontact')}}' , '{{$contact->id}}')" >Delete</button>
    </tr>
    @php
        $num++;
    @endphp
@endforeach
</table>
{{$contacts->links('paginator')}}
</div>
</div>


</div>


@endsection