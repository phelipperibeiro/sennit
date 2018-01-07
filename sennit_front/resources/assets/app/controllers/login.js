app.controller('loginController', function ($scope, $http, API_URL, FRONT_URL) {

    $scope.login = function () {

        var email = $scope.email;
        var password = $scope.password;

        $http.get(API_URL + "auth/login?email=" + email + "&password=" + password)
        .then(function (success) {
            token = success.access_token;
            console.log(success.access_token);
            //window.location.href = FRONT_URL;
        }, function (error) {
            console.log(error);
            alert('erro ao tentar logar');
        });

    }


});