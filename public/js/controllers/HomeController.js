/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('HomeController',HomeController);

    function HomeController(Ring,$location){
        this.Ring = Ring;
        this.$location = $location;

        this.rings = [];

        this.loadRings();

    }

    HomeController.prototype.loadRings = function(){
        var vm = this;

        vm.rings = vm.Ring.query();
    };

    HomeController.prototype.delete = function(ring){
        var vm = this;

        ring.$delete();
        vm.loadRings();
    };

    HomeController.prototype.navigate = function(ring){
        this.$location.path('rings/'+ring.id);
    };



})();