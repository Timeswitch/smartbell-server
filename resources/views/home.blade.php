<!DOCTYPE html>
<html>
    <head>
        <title>SmartBell</title>
        <link rel="stylesheet" href="{{ asset('lib/angular-material/angular-material.min.css')}}">
    </head>
    <body ng-app="smartbell" ng-cloak>

        <div ng-view></div>

        <script src="{{ asset('lib/angular/angular.min.js') }}"></script>
        <script src="{{ asset('lib/angular-route/angular-route.min.js') }}"></script>
        <script src="{{ asset('lib/angular-animate/angular-animate.min.js') }}"></script>
        <script src="{{ asset('lib/angular-aria/angular-aria.min.js') }}"></script>
        <script src="{{ asset('lib/angular-messages/angular-messages.min.js') }}"></script>
        <script src="{{ asset('lib/angular-material/angular-material.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Controllers -->
        <script src="{{ asset('js/controllers/LoginController.js') }}"></script>
    </body>
</html>
