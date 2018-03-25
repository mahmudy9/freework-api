@extends('admin.dashboard')

@section('content')
<div class="container">

<div class="row justify-content-center">
<div class="col-8">
<h2>Customer Register</h2>
@include('errors')
@include('flash')
<form method="post" action="{{url('admin/updateprofile')}}" >
@csrf
  <div class="form-row">

    <div class="form-group col-md-12">
      <label for="inputEmail4">Customer Email</label>
      <input type="email" name="email" value="{{$admin->email}}" class="form-control" id="inputEmail4" placeholder="Customer Email">
    </div>
</div>

  <div class="form-row">
      <div class="form-group col-md-12">
      <label for="inputEmail4">Customer Name</label>
      <input type="text" name="name" class="form-control" value="{{$admin->name}}" id="inputEmail4" placeholder="Customer Name" required>
      </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" name="address" value="{{$admin->address}}" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" name="city" value="{{$admin->city}}" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Phone</label>
      <input type="text" name="phone" value="{{$admin->phone}}" class="form-control" id="inputZip" required>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
</div>
</div>


</div>


@endsection