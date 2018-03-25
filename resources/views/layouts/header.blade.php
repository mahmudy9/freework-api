<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>FreeWork App</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>

.footer {
  position: relative;
  bottom: 0;
  width: 100%;
  height: 60px; /* Set the fixed height of the footer here */
  line-height: 60px; /* Vertically center the text there */
  background-color: #f5f5f5;
}

    </style>
  </head>
  <body>

    <header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">FreeWork</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('contact') }}">Contact</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href=" {{ url('about') }} ">About</a>
            </li>
          </ul>
          </div>
         

<ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            
                            <li class="nav-item dropdown">
                                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Register
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{url('/customer/register')}}">Register As Customer</a>
                                      <a class="dropdown-item" href="{{url('worker/register')}}">Register As FreeWorker</a>
                                      <a class="dropdown-item" href="{{url('company/register')}}">Register As Company</a>
                                    </div>
                            </li>
                            
                            
                            <li><a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            
                                  
                          @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link active dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ substr(Auth::user()->name, 0 ,20) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                    Dashboard
                                    </a>
                                    @elseif(Auth::user()->hasRole('customer'))
                                    <a class="dropdown-item" href="{{ url('customer/addjob') }}" >Add Job</a>
                                    <a class="dropdown-item" href="{{ url('customer/myjobs') }}" >My Job</a>
                                    <a class="dropdown-item" href="{{ url('customer/editprofile') }}" >Edit Profile</a>

                                    @elseif(Auth::user()->hasRole('worker'))
                                    <a class="dropdown-item" href=" {{url('worker/myrequests')}} " >My Requests</a>
                                    <a class="dropdown-item" href=" {{url('worker/acceptedrequests')}} ">Accepted Requests</a>
                                    <a class="dropdown-item" href=" {{url('worker/refusedrequests')}} ">Refused Requests</a>
                                    <a  class="dropdown-item" href=" {{url('worker/editprofile')}} " >Edit my profile</a>
                                    @elseif(Auth::user()->hasRole('company'))
                                    <a class="dropdown-item" href=" {{url('company/myrequests')}} " >Company Requests</a>
                                    <a class="dropdown-item" href=" {{url('company/acceptedrequests')}} ">Accepted Requests</a>
                                    <a class="dropdown-item" href=" {{url('company/refusedrequests')}} ">Refused Requests</a>
                                    <a class="dropdown-item" href=" {{url('company/editprofile')}} " >Edit Company profile</a>
                                    @endif
                                    

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>    
                    </div>
    </nav>
   </header>
<br><br>
 <div class="modal" id="modall" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="savebtn" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

      <!-- FOOTER -->
