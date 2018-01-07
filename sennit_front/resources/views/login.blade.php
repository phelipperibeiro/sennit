<!DOCTYPE html>
<html ng-app="appCepModule">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Consulta de Cep</title>

        <!-- Load Bootstrap CSS -->
        @if(Config::get('app.debug'))
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        @else
        <link href="{{ asset('assets/css/all.css')}}" rel="stylesheet">
        @endif

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <br>
        <br>
        <br>
        
        
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4" ng-controller="loginController" >
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Faça o Login Abaixo</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" name="frmlogin"  novalidate="">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" ng-model="email" placeholder="E-mail" name="email" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" ng-model="password" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-lg btn-success btn-block" ng-click="login()" >Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  


        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="{{ asset('assets/js/angular.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
        

        <script> var token;</script>

        <!-- AngularJS Application Scripts --> 
        @if(Config::get('app.debug'))
        <script src="{{ asset('assets/app/app.js')}}"></script>
        <script src="{{ asset('assets/app/controllers/login.js')}}"></script>
        @else
        <script src="{{ asset('assets/js/app_all.js')}}"></script>
        @endif

    </body>

</html>
