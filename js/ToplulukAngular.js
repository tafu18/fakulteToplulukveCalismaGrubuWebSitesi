var app = angular.module("toplulukApp",  ['ngMaterial', 'ngMessages']);
app.controller("toplulukCtrl", function($scope, $http, $timeout){
/*   $scope.donation_types = ['Yemek Kartı Yardımı (Üniversite için)', 'Elbise Yardımı', 'Ayakkabı Yardımı', 'Mont Yardımı', 'Soba Yakıtı Yardımı',
   'Eğitim Masrafı Yardımı', 'Kitap Yardımı', 'Fatura Yardımı', 'Yemek Yardımı', 'Diğer Yardımlar']; */
   $scope.deneme = "Denemedir. ";

    $scope.isSelect = false;
    $scope.isSelectTopluluk = true;

    $scope.toggleTopluluk = function(){
        $scope.isSelectTopluluk = $scope.isSelectTopluluk ? false : true;
        if($scope.isSelectTopluluk == true) $scope.isSelect = false;
    },
//isSelect --> çalışma grubu |||||| isSelectTopluluk --> topluluk
    $scope.toggle = function(){
        $scope.isSelectTopluluk = $scope.isSelectTopluluk ? false : true;
        $scope.isSelect = $scope.isSelect ? false : true;
        
    },

    $scope.getClass = function() {
        if($scope.isSelect) {
            return 'selected';
        }
        else {
            return 'unSelected';
        }
    },

    $scope.getClass2 = function(){
        if($scope.isSelectTopluluk)
            return 'selected'
        else {
            return 'unSelected';
        }
    }

    $scope.deneme = function(){
        $http.get("sqlDeneme.php").then(function (response) {
            $scope.controls = response.data;
            console.log($scope.controls);
        });
    }

});

app.controller("demandsCtrl", function($scope, $http, $timeout){
    $scope.sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

    $scope.shoes_sizes = [];
    for (let i = 25;  i<= 47; i++) {
        $scope.shoes_sizes.push(i);
    }


});

