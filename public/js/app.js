/**
 * Created by michael on 16/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers',[]);

    angular.module('smartbell', ['ngMaterial','ngRoute','smartbell.controllers'])
        .config(function($routeProvider){
            $routeProvider
                .when('/login',{
                    templateUrl: 'templates/login.html',
                    controller: 'LoginController as loginController'
                })
                .otherwise({
                    redirectTo: '/login'
                });

        });
})();
