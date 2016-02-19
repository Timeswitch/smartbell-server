/**
 * Created by michael on 18/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('BellRingController',BellRingController);

    function BellRingController($routeParams,$location,Bell,Ring){
        var vm = this;
        vm.Bell = Bell;
        vm.Ring = Ring;
        vm.$location = $location;

        vm.id = $routeParams.id;
        vm.rings = [];
        vm.bell = {};

        vm.load();
    }

    BellRingController.prototype.load = function(){
        var vm = this;
        vm.Bell.get({bellId: this.id},function(bell){
            vm.rings = bell.rings;
            vm.bell = bell;
        });
    };

    BellRingController.prototype.delete = function(ring){
        var vm = this;
        vm.Ring.delete({ringId: ring.id});
        vm.load();

    };

    BellRingController.prototype.navigate = function(ring){
        this.$location.path('rings/'+ring.id);
    };

})();