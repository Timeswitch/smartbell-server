/**
 * Created by michael on 17/02/16.
 */
(function(){
    'use strict';

    angular.module('smartbell.controllers').controller('BellController',BellController);

    function BellController(Bell){

        this.bells = Bell.query();
    }

})();