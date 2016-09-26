<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="bower_components/angular-material/angular-material.css">
    </head>
    <body ng-app="ParticleApp">
        <md-toolbar layout="row" class="md-toolbar-tools">
            <h1>Integração Particle Photon</h1>
        </md-toolbar>
        <br />
        <br />
        <br />
        <div ng-controller="ParticleController" layout="column">
            <md-button class="md-accent md-raised">Para frente</md-button>
            <md-button class="md-primary md-raised">Para direita</md-button>
            <md-button class="md-primary md-raised">Para esquerda</md-button>
            <md-button class="md-accent md-raised">Para trás</md-button>
        </div>
        <div style="visibility: hidden">
  <div class="md-dialog-container" id="myStaticDialog">
    <md-dialog>
      Aguarde ...
    </md-dialog>
  </div>
</div>
        <script src="bower_components/angular/angular.js"></script>
        <script src="bower_components/angular-aria/angular-aria.js"></script>
        <script src="bower_components/angular-animate/angular-animate.js"></script>
        <script src="bower_components/angular-material/angular-material.js"></script>
        <script>
            // Include app dependency on ngMaterial
            angular.module( 'ParticleApp', [ 'ngMaterial' ] )
                .controller("ParticleController", function($scope, $mdDialog, $http){
                    $mdDialog.show({
                        contentElement: '#myStaticDialog',
                        parent: angular.element(document.body)
                    });

                    $scope.goLeft = function(){
                        dados = {args: 'up'}; 
                        var trs = [];
                        trs['args'] = 'up';
                        $http({
                            method: 'POST',
                            url: '',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            transformRequest: function(obj) {
                                var str = [];
                                for(var p in obj)
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                return str.join("&");
                                },
                            data: dados
                        }).then(function successCallback(response) {
                            console.log("sucesso "+response);
                        }, function errorCallback(response) {
                            console.log("erro: "+response);
                        });
                    }
                    $scope.goLeft();
            });
        </script>
    </body>
</html>