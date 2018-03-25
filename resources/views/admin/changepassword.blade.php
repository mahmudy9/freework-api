@extends('admin.dashboard')


@section('content')
<div class="container">
<h2>Change Password</h2>

<div class="row">
<div class="col-8">
@include('errors')
@include('flash')
<form action="{{url('/admin/changepassword')}}" method="post" >
@csrf

<div class = "form-group">
<label for="old-pass">Old Password</label>
<input class="form-control" name="old_pass" type="password" required />
</div>
<div class = "form-group">
<label for="password">New Password</label>
<input class="form-control" name="password" type="password" required />
</div>
<div class = "form-group">
<label for="password_confirmation">Confirm Password</label>
<input class="form-control" name="password_confirmation" type="password" required />
</div>
<div class = "form-group">
<label for="submit"></label>
<input class="form-control btn btn-danger" name="old-pass" type="Submit" value="Change Password" />
</div>


</form>

</div>

</div>

</div>


@endsection