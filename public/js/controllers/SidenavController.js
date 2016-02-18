/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SidenavController',SidenavController);

    function SidenavController($rootScope, $mdSidenav, $auth, Bell){
        this.$rootScope = $rootScope;
        this.$mdSidenav = $mdSidenav;
        this.$auth = $auth;
        this.Bell = Bell;

        this.bells = this.queryBells();

        this.$rootScope.toggleNav = this.toggleNav.bind(this);
    }

    SidenavController.prototype.toggleNav = function(id){
        this.$mdSidenav(id).toggle();
    };

    SidenavController.prototype.queryBells = function(){
        if(this.$auth.isAuthenticated()){
            return this.bells = this.Bell.query();
        }

        return [];
    }

})();