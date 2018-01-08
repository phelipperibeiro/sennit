app.controller('companyController', function ($scope, $http, API_URL, TOKEN) {

    var token_api = TOKEN;

    $scope.showModal = function () {

        $scope.id = null;
        $scope.email = null;
        $scope.company = null;
        $scope.password = null;

        $('#myModal').modal('show');
    }

    $http.get(API_URL + "company/search?token=" + token_api)
            .then(function (success) {
                console.log(success);
                $scope.companies = success;
            }, function (error) {
                console.log(error);
            });


    $scope.updateCompany = function (id) {

        $http.get(API_URL + "company/search/" + id + "?token=" + token_api)
                .then(function (success) {

                    console.log(success);

                    $scope.id = success.data.id;
                    $scope.email = success.data.email;
                    $scope.company = success.data.company;

                    $('#myModal').modal('show');

                }, function (error) {
                    console.log(error);
                    alert('Unable to delete');
                });

    }

    $scope.saveDataCompany = function () {

        var id = $scope.id;
        var email = $scope.email;
        var company = $scope.company;
        var password = $scope.password;
        var $action;

        if (!id) {
            $http({
                method: 'POST',
                data: {'id': id, 'email': email, 'company': company, 'password': password},
                url: API_URL + "company/create?token=" + token_api
            }).then(function (success) {
                console.log(success);
                location.reload();
            });

        } else {

             $http({
                method: 'PUT',
                data: {'id': id, 'email': email, 'company': company, 'password': password},
                url: API_URL + 'company/update/' + id + "?token=" + token_api
            }).then(function (success) {
                console.log(success);
                location.reload();
            });
        }
        
    }

    $scope.confirmDelete = function (id) {

        var isConfirmDelete = confirm('Voce realmente quer apagar esta company do banco de dados?');

        if (isConfirmDelete) {

            $http({
                method: 'DELETE',
                url: API_URL + 'company/delete/' + id + "?token=" + token_api
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