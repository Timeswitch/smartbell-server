/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('BellController',BellController);

    function BellController(Bell, $location, $rootScope){

        this.Bell = Bell;
        this.$rootScope = $rootScope;
        this.$location = $location;
        this.bells = Bell.query();
    }

    BellController.prototype.update = function(bell){
        bell.$save();
    };

    BellController.prototype.show = function(bell){
        this.$location.path('/bells/'+bell.id);
    };

    BellController.prototype.openMenu = function($mdOpenMenu, ev){
        $mdOpenMenu(ev);
    };

    BellController.prototype.delete = function(bell){
        var vm = this;

        bell.$delete(function(){
            vm.$rootScope.$broadcast("bellsUpdated");
            vm.bells = vm.Bell.query();
        });
    };

})();