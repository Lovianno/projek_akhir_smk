<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>B Center - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="" style="background-image: url('{{ asset('template/img/fix.jpg') }}'); background-repeat: no-repeat; background-size: cover;  background-position-y: -250px ;
">

    <div class="container ">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-5 col-lg-5 col-md-4 ">

                <div class="card o-hixdden border-0 shadow-lg my-5 " style="background-color: rgba(0, 0, 0, 0.418);">
                    <div class="card-body p-0 ">
                        <!-- Nested Row within Card Body -->
                        <div class="row ">
                            {{-- <img src="{{ asset('template/img/smk1.jpg') }}" class="col-lg-6 d-none d-lg-block"> --}}
                            {{-- <div class="col-lg-0 d-none d-lg-block" style="background-image: url('{{ asset('template/img/smk1.') }}');"></div> --}}
                            
                            <div class="col-lg-12" >
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-light mb-4">Selamat Datang!</h1>
                                    </div>
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    @endif
                                    <form action="login" method="post" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password"placeholder="Password">
                                        </div>
                                        
                                        <input type="submit" value="LOGIN" class="btn btn-success btn-user btn-block">
                                    </form>
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
