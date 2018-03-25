<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <link rel="icon" href="../../../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">FreeWork Company</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        </ul>
            <ul class="navbar-nav px-3">

        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" >Sign out</a>
        </li>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/dashboard')}}">
                  <span data-feather="file"></span>
                  Dashboard (Home)
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/jobstoapprove')}}">
                  <span data-feather="file"></span>
                  Jobs To Approve
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/disapprovedjobs')}}">
                  <span data-feather="file"></span>
                  Disapproved Jobs
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/approvedjobs')}}">
                  <span data-feather="file"></span>
                  Approved Jobs
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/requests')}}">
                  <span data-feather="file"></span>
                  Job Requests
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/acceptedrequests')}}">
                  <span data-feather="file"></span>
                  Accepted Jobs Requests
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/freeworkers')}}">
                  <span data-feather="file"></span>
                  Free Workers list
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/companies')}}">
                  <span data-feather="file"></span>
                  Companies List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/customers')}}">
                  <span data-feather="file"></span>
                  Customers List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/contacts')}}">
                  <span data-feather="file"></span>
                  Contacts List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/editprofile')}}">
                  <span data-feather="file"></span>
                  Edit Profile
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('admin/changepassword')}}">
                  <span data-feather="file"></span>
                  Change Password
                </a>
              </li>


             
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
            <div class="modal" id="modal2" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are You sure?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" id="savebtn" class="btn btn-primary">Save changes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/jquery.min.js')}}" ></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script src="{{asset('js/custom.js')}}" ></script>
    <!-- Graphs -->
  </body>
</html>
