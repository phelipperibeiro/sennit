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


                <div class="panel panel-default">

                    <div class="panel-body">

                        <h2>Consulta de Cep</h2>

                        <div  ng-controller="cepController">

                            <table class="table">

                                <thead>                    
                                    <tr>
                                        <th>CEP</th>
                                        <th>logradouro</th>
                                        <th>complemento</th>
                                        <th>bairro</th>
                                        <th>localidade</th>
                                        <th>uf</th>
                                        <th>unidade</th>
                                        <th>ibge</th>
                                        <th>gia</th>
                                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="showModal()">Nova consulta de cep</button></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr ng-repeat="row in ceps.data">

                                        <td>@{{ row.cep}} </td>
                                        <td>@{{ row.logradouro}} </td>
                                        <td>@{{ row.complemento}} </td>
                                        <td>@{{ row.bairro}} </td>
                                        <td>@{{ row.localidade}} </td>
                                        <td>@{{ row.uf}} </td>
                                        <td>@{{ row.unidade}} </td>
                                        <td>@{{ row.ibge}} </td>
                                        <td>@{{ row.gia}} </td>
                                        <td>
                                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(row.cep)">Delete</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Consultar CEP</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>


                                        <div class="modal-body">
                                            <form name="frmCep" class="form-horizontal" novalidate="">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="cep" >Cep</label>
                                                        <input type="text" class="form-control" ng-model="cep" id="cep" ui-mask="99999-999" ng-keyup="updateCepMask()" ng-pattern="/^[0-9]{5}[-]*[0-9]{3}$/" name="cep" ng-required="true">
                                                        <span class="help-inline" ng-show="frmCep.cep.$invalid && frmCep.cep.$touched">Cep Incorreto</span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="btn-save" ng-disabled="frmCep.cep.$invalid" ng-click="searchCep()" >Consultar</button>
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
        <input type="hidden" id="token" value="{{ $token }}"> 

        <script> var token = $("#token").val();</script>

        <!-- AngularJS Application Scripts --> 
        @if(Config::get('app.debug'))
            <script src="{{ asset('assets/app/app.js')}}"></script>
            <script src="{{ asset('assets/app/controllers/cep.js')}}"></script>
        @else
            <script src="{{ asset('assets/js/app_all.js')}}"></script>
        @endif






    </body>