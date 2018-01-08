app.controller('loginController', function ($scope, $http, API_URL, FRONT_URL) {

    $scope.login = function () {

        var email = $scope.email;
        var password = $scope.password;

        $http.get(FRONT_URL + "authenticate?email=" + email + "&password=" + password)
        .then(function (success) {
            if (success.status = 'success') {
                token = success.token;
                return window.location.href = FRONT_URL;
            }

            alert('erro ao tentar logar');

        }, function (error) {
            console.log(error);
            alert('erro ao tentar logar');
        });

    }


});