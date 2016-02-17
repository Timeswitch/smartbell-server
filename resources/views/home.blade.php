<!DOCTYPE html>
<html>
    <head>
        <title>SmartBell</title>
        <link rel="stylesheet" href="{{ asset('lib/angular-material/angular-material.min.css')}}">
    </head>
    <body ng-app="smartbell" layout="column" ng-cloak>

        <md-toolbar md-scroll-shrink ng-if="true">
            <div class="md-toolbar-tools">
                <h3>
                    <span>SmartBell</span>
                </h3>
            </div>
        </md-toolbar>

        <md-content flex ng-view>
        </md-content>

        <script src="{{ asset('lib/angular/angular.min.js') }}"></script>
        <script src="{{ asset('lib/angular-route/angular-route.min.js') }}"></script>
        <script src="{{ asset('lib/angular-animate/angular-animate.min.js') }}"></script>
        <script src="{{ asset('lib/angular-aria/angular-aria.min.js') }}"></script>
        <script src="{{ asset('lib/angular-messages/angular-messages.min.js') }}"></script>
        <script src="{{ asset('lib/angular-material/angular-material.min.js') }}"></script>

        <script src="{{ asset('lib/satellizer/satellizer.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Controllers -->
        <script src="{{ asset('js/controllers/LoginController.js') }}"></script>
        <script src="{{ asset('js/controllers/SignupController.js') }}"></script>
    </body>
</html>
