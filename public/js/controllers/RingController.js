/**
 * Created by michael on 19/02/16.
 */

(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('RingController',RingController);

    function RingController($routeParams,Ring){
        this.ring = Ring.get({ringId: $routeParams.id});
    }

})();