<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hệ thống CUSC</title>
    <link rel="stylesheet" href="css/app.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng Nhập Hệ Thống</h1>
                                        @if($errors->has('msg'))
                                        <div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Đã xảy ra lỗi!</strong> {{ $errors->first('msg') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        @endif
                                    </div>
                                    <form class="user" action="" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control form-control-user"
                                                id="email" aria-describedby="usernameHelp"
                                                placeholder="Nhập tài khoản">
                                                
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật Khẩu">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input name="rememberMe" type="checkbox" class="custom-control-input" id="customCheck">
                                                <label name="chbox" class="custom-control-label" for="customCheck">Ghi
                                                    nhớ phiên đăng nhập</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="btnSubmit" value="Đăng nhập"
                                            class="btn btn-primary btn-user btn-block">
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
    <script src="js/app.js"></script>
</body>
</html>
