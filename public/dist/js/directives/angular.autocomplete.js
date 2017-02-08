var mydir = angular.module("my-autocomplete",['myapp']);

mydir.directive('maxAutocomplete', function(config){

	return {
		restrict: "E",
		scope: {
			items : '='
		},
		controller: function($scope) {
			console.log("items " + $scope.items);
		},
		templateUrl: config._views_url + "directives/max-auto.html",
		link: function(scope, element) {

			console.log('link');
			console.log(arguments);
			var dropdownVisible = false;
			var inputScope = element.find('input').isolateScope();
			scope.activeItemIndex = 2;
			scope.inputValue = '';	

			var selectNextItem = function() {
				var nextItem = scope.activeItemIndex + 1;
				if(nextItem < scope.items.length) {
					scope.setActive(nextItem);
				}
			}

			var selectPrevItem = function() {
				var prevItem = scope.activeItemIndex - 1;
				if(prevItem >= 0) {
					scope.setActive(prevItem);
				}
			}


			scope.setActive = function (itemIndex) {
				scope.activeItemIndex = itemIndex;
				// scope.$apply();
			}

			scope.selectItem = function(item) {
				scope.inputValue = 	item;
				scope.hideDropdown();
			}

			scope.inputFocus = function() {
				console.log('focused');
				scope.showDropdown();
				
			}

			scope.showDropdown = function () {
				scope.dropdownVisible = true;
			}

			scope.hideDropdown = function () {
				scope.dropdownVisible = false;
			}

			element.bind('keypress keydown', function(){
				console.log(event.which);
				switch (event.which) {
					case 38: // up
						console.log('select next');
						scope.$apply(selectPrevItem());
						
						break;
					case 40:  // down
						console.log('select prev');
						scope.$apply(selectNextItem());
						break;
					case 13: // enter
						console.log('entered');
						break;
				}
			});

		}
	};
})


