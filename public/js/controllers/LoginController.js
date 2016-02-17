/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('LoginController',LoginController);

    function LoginController($scope,$auth,$location){
        this.$scope = $scope;
        this.$auth = $auth;
        this.$location = $location;

        this.user = {
            email: '',
            password: ''
        };

        this.formErrors = false;

        if(this.$auth.isAuthenticated()){
            this.$location.path('/home');
        }
    }

    LoginController.prototype.login = function(){
        var vm = this;

        vm.$auth.login(vm.user).then(function(){
            vm.$location.path('/home');
        }).catch(function(){
            vm.formErrors = true;
        });
    };

})();