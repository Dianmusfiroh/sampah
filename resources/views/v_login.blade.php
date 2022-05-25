<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ $title }}</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="backend/assets/imgs/theme/favicon.svg" />
        <!-- Template CSS -->
        <link href="backend/assets/css/main.css?v=1.0" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <main>
            <section class="content-main mt-100 mb-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign in</h4>
                        <form action="login" method="post">
                        @csrf
                            <div class="mb-3">
                                <input class="form-control" name="user" alue="{{ old('user') }}" placeholder="Username or email" type="text" />
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <input class="form-control" name="pass" alue="{{ old('pass') }}" placeholder="Password" type="password" />
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <a href="#" class="float-end font-sm text-muted">Forgot password?</a>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked="" />
                                    <span class="form-check-label">Remember</span>
                                </label>
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
        <!-- Main Script -->
        <script src="backend/assets/js/main.js?v=1.0" type="text/javascript"></script>
    </body>
</html>
