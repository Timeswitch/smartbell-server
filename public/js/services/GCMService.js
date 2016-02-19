/**
 * Created by michael on 18/02/16.
 */

(function(){
    angular.module('smartbell.services').service('GCMService',GCMService);

    function GCMService($http,$window){
        var svc = this;

        svc.$http = $http;
        svc.$window = $window;

        svc.subscribtion = null;
        svc.supported = false;
        svc.enabled = $window.localStorage.getItem('disablePush') == null;
    }

    GCMService.prototype.init = function(){
        var svc = this;
        if (!'serviceWorker' in navigator) {
            return;
        }

        if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
            console.warn('Benachrichtigungen werden nicht unterstützt.');
            return;
        }

        if (Notification.permission === 'denied') {
            console.warn('The user has blocked notifications.');
            return;
        }

        if (!('PushManager' in window)) {
            console.warn('Push messaging isn\'t supported.');
            return;
        }

        navigator.serviceWorker.register('gcm.js').then(function(reg) {
            console.log('ServiceWorker registriert', reg);
        });


        navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
            serviceWorkerRegistration.pushManager.getSubscription()
                .then(function(subscription) {

                    svc.supported = true;

                    if (!subscription) {

                        if(svc.enabled){
                            return svc.subscribe();
                        }
                        return;
                    }

                    // Keep your server in sync with the latest subscriptionId
                    svc.registerSubscription(subscription);

                    // Set your UI to show they have subscribed for
                    // push messages
                    svc.enabled = true;
                })
                .catch(function(err) {
                    console.warn('Error during getSubscription()', err);
                });
        });
    };

    GCMService.prototype.isSupported = function(){
        return this.supported;
    };

    GCMService.prototype.subscribe = function(){
        var svc = this;
        svc.enabled = true;

        return navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
            serviceWorkerRegistration.pushManager.subscribe({userVisibleOnly: true})
                .then(function(subscription) {
                    // The subscription was successful
                    svc.enabled = true;

                    svc.registerSubscription(subscription);
                })
                .catch(function(e) {
                    if (Notification.permission === 'denied') {
                        console.warn('Permission for Notifications was denied');
                        svc.supported = false;
                    } else {
                        console.error('Unable to subscribe to push.', e);
                    }
                });
        });
    };

    GCMService.prototype.unsubscribe = function(){
        var svc = this;

        if(svc.subscribtion != null){
            var token = /[^/]*$/.exec(svc.subscribtion.endpoint)[0];
            svc.subscribtion.unsubscribe().then(function(){
                svc.enabled = false;
                var httpConfig = {
                    method: 'POST',
                    url: 'api/v1/unsubscribe',
                    data: {
                        push_token: token
                    }
                };

                svc.$http(httpConfig).then(function(response){
                    if(response.status == 200){
                        svc.$window.localStorage.removeItem('client_id');
                    }
                });
            });
        }
    };

    GCMService.prototype.registerSubscription = function(subscription){
        var svc = this;
        var token = /[^/]*$/.exec(subscription.endpoint)[0];

        var clientId = svc.$window.localStorage.getItem('client_id');
        var httpConfig = {
            method: 'POST',
            url: 'api/v1/subscribe',
            data: {
                push_token: token
            }
        };

        svc.subscribtion = subscription;

        if(clientId != null){
            httpConfig.url += '/'+clientId
        }

        svc.$http(httpConfig).then(function(response){
            if(response.status == 200){
                svc.$window.localStorage.setItem('client_id',response.data.id);
            }
        });


    };

    GCMService.prototype.showNotification = function(){
        new Notification('Notification title', {
            icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
            body: "Hey there! You've been notified!",
        });
    }

})();