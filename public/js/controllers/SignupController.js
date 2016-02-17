/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SignupController',SignupController);

    function SignupController($rootScope,$auth,$location){
        this.$rootScope = $rootScope;
        this.$auth = $auth;
        this.$location = $location;

        this.user = {
            email: '',
            password: '',
            passwordRepeat: ''
        };

        this.formErrors = false;

        if(this.$auth.isAuthenticated()){
            this.$location.path('/home');
        }else{
            this.$rootScope.showNavs = false;
        }
    }

    SignupController.prototype.signup = function(){
        var vm = this;

        vm.$auth.signup(vm.user)
            .then(function(){
                vm.$location.path('/login');
            }).catch(function(){
                vm.formErrors = true;
            });
    };


})();