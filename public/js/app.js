/**
 * Created by michael on 16/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers',[]);
    angular.module('smartbell.factories',[]);
    angular.module('smartbell.services',[]);

    angular.module('smartbell', ['ngMaterial','ngRoute', 'ngResource','satellizer','smartbell.controllers','smartbell.factories','smartbell.services'])
        .config(function($httpProvider, $authProvider, $routeProvider){

            $httpProvider.interceptors.push('TokenRefreshInterceptor');

            $authProvider.loginUrl = '/api/v1/auth/login';
            $authProvider.signupUrl = '/api/v1/auth/signup';

            $routeProvider
                .when('/home',{
                    templateUrl: 'templates/home.html',
                    controller: 'HomeController as homeController'
                })
                .when('/bells',{
                    templateUrl: 'templates/bells.html',
                    controller: 'BellController as bellController'
                })
                .when('/rings/:id',{
                    templateUrl: 'templates/ring.html',
                    controller: 'RingController as ringController'
                })
                .when('/bells/:id',{
                    templateUrl: 'templates/bellRings.html',
                    controller: 'BellRingController as bellRingController'
                })
                .when('/login',{
                    templateUrl: 'templates/login.html',
                    controller: 'LoginController as loginController'
                })
                .when('/signup',{
                    templateUrl: 'templates/signup.html',
                    controller: 'SignupController as signupController'
                })
                .otherwise({
                    redirectTo: '/login'
                });

        }).run(function($rootScope){
            $rootScope.showNavs = true;

    });
})();
