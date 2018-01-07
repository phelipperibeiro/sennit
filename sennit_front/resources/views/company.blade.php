<!DOCTYPE html>

<html ng-app="appCepModule">

    <head>
        <title>Sennit</title>

        <!-- Load Bootstrap CSS -->
        @if(Config::get('app.debug'))
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        @else
        <link href="{{ asset('assets/css/all.css')}}" rel="stylesheet">
        @endif

    </head>

    <body>
        

        <div class="container">
            

            <div class="panel-group">


                @include('menu')
                
                <div class="panel panel-default">

                    <div class="panel-body">

                        <h2>Company</h2>

                        <div  ng-controller="companyController">

                            <table class="table">

                                <thead>                    
                                    <tr>
                                        <th>ID</th>
                                        <th>Company</th>
                                        <th>Email</th>
                                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="showModal()">Cadastrar nova company</button></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr ng-repeat="row in ceps.data">

                                        <td>@{{ row.id}} </td>
                                        <td>@{{ row.company}} </td>
                                        <td>@{{ row.email}} </td>
                                        <td>
                                            <button class="btn btn-success btn-xs btn-success" ng-click="updateCompany(row.id)">Editar</button>
                                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(row.id)">Deletar</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Cadastro de Company</h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>


                                        <div class="modal-body">
                                            <form name="frmCompany" class="form-horizontal" novalidate="">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="company" >Company</label>                                                           
                                                        <input type="hidden" ng-model="id" id="id">
                                                        <input type="text" class="form-control" ng-model="company" id="company" name="company" ng-required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="email" >Email</label>
                                                        <input type="text" class="form-control" ng-model="email" id="email" name="email" ng-required="true"> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="password" >Passawod</label>
                                                        <input type="password" class="form-control" ng-model="password" id="password" name="password" ng-required="true">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="btn-add-company"  ng-click="saveDataCompany()" >Salvar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="myModalResponse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Dados da Consulta</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="table-responsive-sm">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">CEP</th>
                                                            <th scope="col">Logradouro</th>
                                                            <th scope="col">Complemento</th>
                                                            <th scope="col">bairro</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td ng-bind="_cep"></td>
                                                            <td ng-bind="_logradouro"></td>
                                                            <td ng-bind="_complemento"></td>
                                                            <td ng-bind="_bairro"></td>                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="table-responsive-md">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Localidade</th>
                                                            <th scope="col">UF</th>
                                                            <th scope="col">Unidade</th>
                                                            <th scope="col">Ibge</th>
                                                            <th scope="col">gia</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td ng-bind="_localidade"></td>
                                                            <td ng-bind="_uf"></td>
                                                            <td ng-bind="_unidade"></td>
                                                            <td ng-bind="_ibge"></td>
                                                            <td ng-bind="_gia"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>>
                                </div>
                            </div>
                            <!-- /.modal -->

                        </div>


                    </div>

                </div>

            </div>

        </div>


        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="{{ asset('assets/js/angular.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

        <!--Token Api--> 
        <input type="hidden" id="token" value="{{ $token}}"> 

        <script> var token = $("#token").val();</script>

        <!-- AngularJS Application Scripts --> 
        @if(Config::get('app.debug'))
        <script src="{{ asset('assets/app/app.js')}}"></script>
        <script src="{{ asset('assets/app/controllers/company.js')}}"></script>
        @else
        <script src="{{ asset('assets/js/app_all.js')}}"></script>
        @endif






    </body>