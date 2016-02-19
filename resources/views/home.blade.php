<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

        <title>SmartBell</title>

        <link rel="manifest" href="/manifest.json">

        <link rel="stylesheet" href="{{ asset('lib/angular-material/angular-material.min.css')}}">
    </head>
    <body ng-app="smartbell" layout="column" ng-cloak>

        <md-toolbar md-scroll-shrink>
            <div class="md-toolbar-tools">
                <md-button hide-gt-sm ng-click="toggleNav('left')" class="md-icon-button" ng-if="showNavs">
                    <md-icon md-svg-src="lib/material-design-icons/navigation/svg/production/ic_menu_24px.svg"></md-icon>
                </md-button>
                <span>SmartBell</span>
                <span flex></span>
                <md-button ng-click="logout()" ng-if="showNavs">
                    Logout
                </md-button>
            </div>
        </md-toolbar>

        <div layout="row" flex>
            <md-sidenav md-component-id="left" flex class="md-sidenav-left md-whiteframe-z2" md-is-locked-open="$mdMedia('gt-sm')" ng-if="showNavs">



                <md-content layout="column" flex layout-fill ng-controller="SidenavController as sidenavController">
                    <md-toolbar md-scroll-shrink hide-gt-sm>
                        <div class="md-toolbar-tools">
                            <span>Navigation</span>
                        </div>
                    </md-toolbar>
                    <md-list flex="grow">
                        <div layout="row" layout-align="start center" flex>
                            <md-button class="md-primary" href="#/home">Alles Anzeigen</md-button>
                            <span flex></span>
                        </div>

                        <div ng-repeat="bell in sidenavController.bells" layout="row" layout-align="start center" flex>
                            <md-button href="#/bells/@{{bell.id}}">
                                <md-icon md-svg-src="{{ asset('lib/material-design-icons/hardware/svg/production/ic_developer_board_24px.svg') }}"></md-icon>
                                @{{ bell.name }}
                            </md-button>
                        </div>

                        <div layout="row" layout-align="start center" flex>
                            <md-button href="#/bells">Klingeln verwalten...</md-button>
                        </div>


                    </md-list>

                    <md-list>
                        <md-divider></md-divider>

                        <div layout="row" layout-align="start center" flex>
                            <md-button>
                                <md-icon md-svg-src="{{ asset('lib/material-design-icons/action/svg/production/ic_settings_24px.svg') }}"></md-icon>
                                Einstellungen
                            </md-button>
                        </div>
                    </md-list>

                </md-content>
            </md-sidenav>

            <md-content flex ng-view>
            </md-content>
        </div>

        <script src="{{ asset('lib/angular/angular.min.js') }}"></script>
        <script src="{{ asset('lib/angular-route/angular-route.min.js') }}"></script>
        <script src="{{ asset('lib/angular-resource/angular-resource.min.js') }}"></script>
        <script src="{{ asset('lib/angular-animate/angular-animate.min.js') }}"></script>
        <script src="{{ asset('lib/angular-aria/angular-aria.min.js') }}"></script>
        <script src="{{ asset('lib/angular-messages/angular-messages.min.js') }}"></script>
        <script src="{{ asset('lib/angular-material/angular-material.min.js') }}"></script>
        <script src="{{ asset('lib/satellizer/satellizer.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Services -->
        <script src="{{ asset('js/services/GCMService.js') }}" ></script>

        <!-- Factories -->
        <script src="{{ asset('js/factories/TokenRefreshInterceptor.js') }}"></script>
        <script src="{{ asset('js/factories/Ring.js') }}"></script>
        <script src="{{ asset('js/factories/Bell.js') }}"></script>

        <!-- Controllers -->
        <script src="{{ asset('js/controllers/SidenavController.js') }}"></script>
        <script src="{{ asset('js/controllers/LoginController.js') }}"></script>
        <script src="{{ asset('js/controllers/SignupController.js') }}"></script>
        <script src="{{ asset('js/controllers/HomeController.js') }}"></script>
        <script src="{{ asset('js/controllers/BellController.js') }}"></script>
        <script src="{{ asset('js/controllers/RingController.js') }}"></script>
        <script src="{{ asset('js/controllers/BellRingController.js') }}"></script>
    </body>
</html>
