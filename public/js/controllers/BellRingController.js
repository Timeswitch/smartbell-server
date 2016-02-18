/**
 * Created by michael on 18/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('BellRingController',BellRingController);

    function BellRingController($routeParams,Bell){
        var vm = this;
        vm.id = $routeParams.id;
        vm.rings = [];
        vm.bell = {};

        Bell.get({bellId: this.id},function(bell){
            vm.rings = bell.rings;
            vm.bell = bell;
        });

    }
})();