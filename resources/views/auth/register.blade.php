<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="admin dashboard, bootstrap 5 admin" />
    <meta name="description" content="Matrix Admin Lite is a powerful admin dashboard template" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Register</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets') }}/images/favicon.png" />
    <link href="{{ asset('admin/assets') }}/css/style.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: lightgray;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height of the viewport */
            margin: 0; /* Remove default margin */
        }
        .auth-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%; /* Full width */
            max-width: 400px; /* Maximum width for the form */
        }
        .input-group {
            margin-bottom: 20px;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
        .input-group-text {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px 0 0 5px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .text-center {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box  border-secondary">
                <div id="registerform">
                    <div class="text-center pt-3 pb-3">
                        <h4>Create Your Account</h4>
                    </div>
                    <form class="form-horizontal mt-3" id="registerform" action="{{ route('register') }}" method="post" novalidate>
                        @csrf
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="mdi mdi-account fs-4"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Name" aria-label="Name" required name="name" />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon2"><i class="mdi mdi-email fs-4"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" required name="email" />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon3"><i class="mdi mdi-lock fs-4"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required name="password" />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon4"><i class="mdi mdi-lock fs-4"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" aria-label="Confirm Password" required name="password_confirmation" />
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12 text-center">
                                <div class="form-group">
                                    <div class="pt-3">
                                        <button class="btn btn-success text-white" type="submit">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('admin/assets') }}/js/bootstrap.bundle.min.js"></script>
    <script>
        $(".preloader").fadeOut();
    </script>
</body>
</html>
