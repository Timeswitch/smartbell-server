/**
 * Created by michael on 17/02/16.
 */

(function(){
    angular.module('smartbell.factories').factory('Ring',Ring);

    function Ring($resource){
        return $resource('api/v1/rings/:ringId');
    }
})();