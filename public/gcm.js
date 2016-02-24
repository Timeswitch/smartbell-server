/**
 * Created by michael on 18/02/16.
 */

(function(){
    'use strict';

    console.log('Started', self);

    self.addEventListener('install', function(event) {
        self.skipWaiting();
        console.log('Installed', event);
    });

    self.addEventListener('activate', function(event) {
        console.log('Activated', event);
    });

    self.addEventListener('push', function(event) {
        console.log('Push message', event);

        event.waitUntil(self.registration.pushManager.getSubscription().then(function(subscription) {

            var token = /[^/]*$/.exec(subscription.endpoint)[0];
            return fetch('api/v1/ring/'+token).then(function(response){
                return response.json();
            }).then(function(data){
                return self.registration.showNotification('SmartBell',{
                    'body': data.bell,
                    'icon': 'img/uploads/'+data.image,
                    'tag': data.id
                });
            });

        }));
    });

    self.addEventListener('notificationclick', function(event) {
        event.notification.close();
        var url = 'https://smartbell.kroll.zone/#/rings/'+event.notification.tag;
        event.waitUntil(
            clients.matchAll({
                    type: 'window'
                })
                .then(function(windowClients) {
                    for (var i = 0; i < windowClients.length; i++) {
                        var client = windowClients[i];
                        if (client.url === url && 'focus' in client) {
                            return client.focus();
                        }
                    }
                    if (clients.openWindow) {
                        return clients.openWindow(url);
                    }
                })
        );
    });

})();