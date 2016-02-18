/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SidenavController',SidenavController);

    function SidenavController($rootScope, $mdSidenav, $auth, $location, Bell){
        this.$rootScope = $rootScope;
        this.$mdSidenav = $mdSidenav;
        this.$location = $location;
        this.$auth = $auth;
        this.Bell = Bell;

        this.bells = this.queryBells();

        this.$rootScope.logout = this.logout.bind(this);
        this.$rootScope.toggleNav = this.toggleNav.bind(this);
    }

    SidenavController.prototype.logout = function(){
        this.$auth.logout();
        this.$location.path('/login');
    };

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