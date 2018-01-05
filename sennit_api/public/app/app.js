var app = angular.module('cepRecords', [])
        .constant('API_URL', 'http://localhost/sennit/public/')
        .constant("CSRF_TOKEN", '{{csrf_token()}}');


