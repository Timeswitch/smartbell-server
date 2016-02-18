/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.factories').factory('TokenRefreshInterceptor',TokenRefreshInterceptor);

    function TokenRefreshInterceptor($window,$location) {
        return {
            response: function (response) {
                if (response.headers('Authorization') != null) {
                    console.log(response.headers('Authorization'));
                    $window.localStorage.setItem('satellizer_token', response.headers('Authorization').replace('Bearer ', ''));
                }

                return response;
            },
            responseError: function(response){
                if(response.config.url != '/api/v1/auth/login' && response.config.url != '/api/v1/auth/signup'){
                    $window.localStorage.removeItem('satellizer_token');
                    $window.localStorage.removeItem('client_id');
                    $location.path('/login');
                }

                return response;
            }
        }
    }
})();