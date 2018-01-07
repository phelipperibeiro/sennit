app.controller('cepController', function ($scope, $http, API_URL, TOKEN) {

    var token_api = TOKEN;
    
    $scope.showModal = function () {
        $('#myModal').modal('show');
    }
    
    $http.get(API_URL + "cep/search?token=" + token_api)
            .then(function (success) {
                console.log(success);
                $scope.ceps = success;
            }, function (error) {
                console.log(error);
            });

    $scope.searchCep = function () {

        var cep = $scope.cep;

        $http.get(API_URL + "cep/search/" + cep + "?token=" + token_api)
                .then(function (success) {

                    $scope._cep = success.data.cep;
                    $scope._logradouro = success.data.logradouro;
                    $scope._complemento = success.data.complemento;
                    $scope._bairro = success.data.bairro;
                    $scope._localidade = success.data.localidade;
                    $scope._uf = success.data.uf;
                    $scope._unidade = success.data.unidade;
                    $scope._ibge = success.data.ibge;
                    $scope._gia = success.data.gia;


                    $('#myModalResponse').modal('show');

                }, function (error) {
                    console.log(error);
                    alert('Unable to delete');
                });

    }

    $scope.confirmDelete = function (cep) {

        var isConfirmDelete = confirm('Voce relamente quer apagar esta consulta do banco de dados?');

        if (isConfirmDelete) {

            $http({
                method: 'DELETE',
                url: API_URL + 'cep/delete/' + cep + "?token=" + token_api
            })
                    .then(function (success) {
                        console.log(success);
                        location.reload();
                    }, function (error) {
                        console.log(error);
                        alert('Unable to delete');
                    });

        } else {

            return false;
        }
    }
});