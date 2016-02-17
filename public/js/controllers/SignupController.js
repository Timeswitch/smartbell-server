/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SignupController',SignupController);

    function SignupController($auth,$location){
        this.$auth = $auth;
        this.$location = $location;

        this.user = {
            email: '',
            password: '',
            passwordRepeat: ''
        };

        this.formErrors = false;
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