/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('LoginController',LoginController);

    function LoginController($rootScope,$auth,$location){
        this.$rootScope = $rootScope;
        this.$auth = $auth;
        this.$location = $location;

        this.user = {
            email: '',
            password: ''
        };

        this.formErrors = false;

        if(this.$auth.isAuthenticated()){
            this.$location.path('/home');
        }else{
            this.$rootScope.showNavs = false;
        }

    }

    LoginController.prototype.login = function(){
        var vm = this;

        vm.$auth.login(vm.user).then(function(response){
            if(response.status != 200){
                throw 'invalid_credentials';
            }
            vm.$rootScope.showNavs = true;
            vm.$location.path('/home');
        }).catch(function(){
            vm.formErrors = true;
        });
    };

})();