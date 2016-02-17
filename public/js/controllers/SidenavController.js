/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SidenavController',SidenavController);

    function SidenavController($rootScope, $mdSidenav){
        this.$rootScope = $rootScope;
        this.$mdSidenav = $mdSidenav;

        this.$rootScope.toggleNav = this.toggleNav.bind(this);
    }

    SidenavController.prototype.toggleNav = function(id){
        this.$mdSidenav(id).toggle();
    };

})();