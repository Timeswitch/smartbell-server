/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('HomeController',HomeController);

    function HomeController(Ring){
        this.Ring = Ring;

        this.rings = [];

        this.loadRings();

    }

    HomeController.prototype.loadRings = function(){
        var vm = this;

        vm.rings = vm.Ring.query();
    }


})();