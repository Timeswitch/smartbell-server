/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SignupController',SignupController);

    function SignupController(){
        this.user = {
            email: '',
            password: '',
            passwordRepeat: ''
        }
    }

    SignupController.prototype.signup = function(){

    };


})();