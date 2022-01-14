<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo3.png">
    <title>Login de Acesso</title>
    <link href="assets/dist/css/style.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        html{
            overflow: hidden;
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

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 boxLogin1 modal-bg-img" style="background-image: url(assets/images/login/2.jpg)">
                </div>
                <div class="col-lg-5 col-md-7 boxLogin2 bg-white">
                    <div class="pt-5 pb-5 pl-3 pr-3">
                        <div class="text-center" alt="wrapkit">
                            <img src="assets/images/logo3.png" width="88">
                        </div>
                        <form id="formLogin" class="mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">E-mail</label>
                                        <input class="form-control" name="email" type="email" placeholder="Meu e-mail">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Senha</label>
                                        <input class="form-control" name="senha" type="password" placeholder="Minha senha">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Entrar</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Esqueci minha senha! <a href="#" class="text-danger">Acessar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(".preloader ").fadeOut();

        $('#formLogin').submit(function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '<?= $router->route ('acesso.acesso'); ?>',
                data: $(this).serialize(),
                success: function (data) {
                    if(data.retorno) {
                        window.location.href = data.url;
                    }

                    if(data.error){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: '<h3>E-mail ou Senha Incorretos!</h3>',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>