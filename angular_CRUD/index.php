<?php
  include 'db_operation/db.php';   //database file include
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>angular inssrt data</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- bootstrap -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <!-- <script src="angular.js"></script> -->
  <style media="screen">
  *{
    margin: 0;padding: 0;outline: 0
   }
    #main{
      width: 500px;
      margin: 20px auto;
      border: 1px solid black;
      border-radius: 10px;
      padding: 10px;
    }
    #main input[type=text]{
      margin-bottom: 10px;
      margin-left: 10px;
    }
    #main #show_data tr td{
      border: 1px solid black;
      padding: 5px;
    }
    button{
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div id="main" ng-app="myApp" ng-controller="formControl" ng-init="displayData()">
  {{error}}
  <br>
  <table>
        <tr>
          <td>firstname :</td>
          <td><input type="text" name="fname" ng-model="firstName" value=""></td>
        </tr>
        <tr>
          <td>lastname :</td>
          <td><input type="text" name="lname" ng-model="lastName" value=""> </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="hidden" ng-model="id"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="sub" value="{{btnName}}" ng-click="insertData()"></td>
        </tr>
      </table>
      <br>
      <table id="show_data">
        <tr>
          <td>Firstname</td>
          <td>Lastname</td>
          <td>action</td>
        </tr>
        <tr ng-repeat = "name in info">
          <td>{{name.firstname}}</td>
          <td>{{name.lastname}}</td>
          <td><button style="color:blue;" type="button" ng-click="updateData(name.id,name.firstname,name.lastname)">update</button> <button type="button" style="color:red;" ng-click="deleteData(name.id)">delete</button></td>
        </tr>
      </table>
  </div>
  <script>
    alert('if cdn link doesnot work then replace that with angular file from libraries folder');
    var app = angular.module('myApp', []).controller('formControl', function ( $scope, $http ) {
      $scope.btnName = "Submit";
      $scope.insertData = function () {
        if ( $scope.firstName == null || $scope.lastName == null ) {
          alert('both field is required');
        }else {
          $http.post('db_operation/data_insert_select.php',  //data pass to insert file
             {
               'firstName' : $scope.firstName,
               'lastName'  : $scope.lastName,
               'id'        : $scope.id,
               'btnName': $scope.btnName
             }
          ).then(function () {         //this is a success function;
            alert( "data is inserted" );
            $scope.firstName = null;
            $scope.lastName = null;
            $scope.btnName = "Submit";
            $scope.displayData();
          });
        }
       }

       $scope.displayData = function () {
         $http.get('db_operation/data.json').then(function ( res ) { //data fetch from json file
           $scope.info = res.data;
           console.log($scope.info);
          });
        }

        $scope.updateData = function ( id, firstname, lastname) {
          $scope.id = id;
          $scope.firstName = firstname;
          $scope.lastName = lastname;
          $scope.btnName = "update";
        }

        $scope.deleteData = function(id){
          $http.post('db_operation/delete.php', {  //delete operation from delete file
            'id' : id
          }).then( function () {
            alert('data is deleted');
            $scope.displayData();
          } )
        }
     } );
  </script>
</body>
</html>
