/**
 * Created by michael on 16/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers',[]);

    angular.module('smartbell', ['ngMaterial','ngRoute','satellizer','smartbell.controllers'])
        .config(function($authProvider, $routeProvider){

            $authProvider.loginUrl = '/api/v1/auth/login';
            $authProvider.signupUrl = '/api/v1/auth/signup';

            $routeProvider
                .when('/home',{
                    templateUrl: 'templates/home.html'
                })
                .when('/login',{
                    templateUrl: 'templates/login.html',
                    controller: 'LoginController as loginController'
                })
                .when('/signup',{
                    templateUrl: 'templats/signup.html'
                })
                .otherwise({
                    redirectTo: '/login'
                });

        });
})();
