/**
 * Created by michael on 17/02/16.
 */

(function(){
    angular.module('smartbell.factories').factory('Bell',Bell);

    function Bell($resource){
        return $resource('api/v1/bells/:bellId');
    }
})();