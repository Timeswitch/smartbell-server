/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.factories').factory('TokenRefreshInterceptor',TokenRefreshInterceptor);

    function TokenRefreshInterceptor($window) {
        return {
            response: function (response) {
                if (response.headers('Authorization') != null) {
                    console.log(response.headers('Authorization'));
                    $window.localStorage.setItem('satellizer_token', response.headers('Authorization').replace('Bearer ', ''));
                }

                return response;
            }
        }
    }
})();