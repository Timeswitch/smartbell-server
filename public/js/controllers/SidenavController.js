/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('SidenavController',SidenavController);

    function SidenavController($rootScope, $window, $mdSidenav, $auth, $location, Bell){
        var vm = this;

        vm.$rootScope = $rootScope;
        vm.$window = $window;
        vm.$mdSidenav = $mdSidenav;
        vm.$location = $location;
        vm.$auth = $auth;
        vm.Bell = Bell;

        vm.bells = [];

        vm.$rootScope.logout = this.logout.bind(vm);
        vm.$rootScope.toggleNav = this.toggleNav.bind(vm);

        vm.queryBells();

        $rootScope.$on( "$routeChangeStart", function(event, next, current) {
            vm.queryBells();
        });

        $rootScope.$on("bellsUpdated",function(){
            vm.queryBells();
        });
    }

    SidenavController.prototype.logout = function(){
        this.$auth.logout();
        this.$window.localStorage.removeItem('client_id');
        this.$location.path('/login');
    };

    SidenavController.prototype.toggleNav = function(id){
        this.$mdSidenav(id).toggle();
    };

    SidenavController.prototype.queryBells = function(){
        var vm = this;
        if(vm.$auth.isAuthenticated()){
            vm.Bell.query(function(bells){
                vm.bells = bells;
            });
        }else{
            vm.bells = [];
        }

    }

})();