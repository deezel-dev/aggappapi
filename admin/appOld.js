  var app = angular.module('app', ["ui.router"]);


  app.config(['$urlRouterProvider', '$stateProvider', function ($urlRouterProvider, $stateProvider) {
      $urlRouterProvider.otherwise('/home');

      $stateProvider

      // HOME STATES AND NESTED VIEWS ========================================
        .state('home', {
            url: '/home',
            templateUrl: 'home.html'
        })

      // FLIX MOVIES PAGE =====================================================
        .state('flix_movies', {
            url: '/flix_movies',
            templateUrl: 'flix_movies.html'
        })

      // FLIX SUGGESTIONS PAGE ================================================
        .state('flix_suggestions', {
            url: '/flix_suggestions',
            templateUrl: 'flix_suggestions.html'
        })

      // MOVIE MAINTENANCE PAGE ===============================================
        .state('movie_maintenance', {
            url: '/movie_maintenance',
            templateUrl: 'movie_maintenance.html'
        })

      // DATA MAINTENANCE PAGE ================================================
        .state('data_maintenance', {
            url: '/data_maintenance',
            templateUrl: 'data_maintenance.html'
        })
  } ])
      .controller('TabsCtrl', ['$scope', '$state', function ($scope, $state) {

          $scope.tabs = [{
              title: 'Topic Management',
              url: 'topic_maintenance.html'
          }];

          $scope.currentTab = 'topic_maintenance.html';


          $scope.selectTab = function (tab) {
              $scope.currentTab = tab.url;
          }

          $scope.isSelected = function (tabUrl) {
              return $scope.currentTab === tabUrl;
          }

      } ])


      .controller('TabsCtrlOLD', ['$scope', '$state', function ($scope, $state) {

          $scope.tabs = [{
              title: 'Flix Movies',
              url: 'flix_movies.html'
          }, {
              title: 'Suggestions',
              url: 'flix_suggestions.html'
          }, {
              title: 'Amazon',
              url: 'amazon_search.html'
          }, {
              title: 'Vendors',
              url: 'vendor_link.html'
          }, {
              title: 'TMDB',
              url: 'tmdb.html'
          }, {
              title: 'OMDB',
              url: 'omdb_search.html'
          }, {
              title: 'GOOGLE',
              url: 'google_api.html'
          }, {
              title: 'RottenTomatoes',
              url: 'rotten_tomatoes.html'
          }, {
              title: 'YouTube',
              url: 'youtube_api.html'
          }, {
              title: 'Topic Management',
              url: 'topic_maintenance.html'
          }];


          $scope.currentTab = 'flix_movies.html';


          $scope.selectTab = function (tab) {
              $scope.currentTab = tab.url;
          }

          $scope.isSelected = function (tabUrl) {
              //if($scope.currentTab = 'flix_movies.html') {
              //alert($scope.currentTab + " = " + tabUrl);
              // $state.current.name = 'home'
              //}
              return $scope.currentTab === tabUrl;
          }

      } ])

      .factory('movieService', function () {
          var savedMovie = {};
          function set(movie) {
              savedMovie = movie;
          }
          function get() {
              return savedMovie;
          }

          return {
              set: set,
              get: get
          }

      })

       .factory("mMessageService", function ($rootScope, $timeout) {

           var messageService = {};

           messageService.message = '';
           messageService.movie = null;
           messageService.suggestionID = -1;
           messageService.imageUrl = '';
           messageService.movieDescription = '';
           messageService.actor = '';
           messageService.director = '';
           messageService.movieRating = '';
           messageService.product_id = -1;

           messageService.prepForBroadcast = function (msg) {
               this.message = msg;
               this.broadcastItem();
           };

           messageService.prepForBroadcast = function (msg, suggestionID) {
               this.message = msg;
               this.suggestionID = suggestionID;
               this.broadcastItem();
           };

           messageService.prepMovieForBroadcast = function (movie) {
               this.movie = movie;
               this.message = movie.title;
               this.broadcastMovie();
           };

           messageService.prepFlixMovieForBroadcast = function (product_id) {
               this.product_id = product_id;
               this.broadcastFlixMovie();
           };


           messageService.prepOMDBMovieForBroadcast = function (movie, id) {
               this.movie = movie;
               this.movie.product_id = id;
               this.message = movie.title;
               this.broadcastOMDBMovie();
           };

           messageService.prepSuggestedMovieForBroadcast = function (movie) {
               this.movie = movie;
               this.message = movie.title;
               this.broadcastSuggestedMovie();
           };

           messageService.setActor = function (actor) {
               this.actor = actor;
               this.broadcastActor();
           };

           messageService.setDirector = function (director) {
               this.director = director;
               this.broadcastDirector();
           };

           messageService.setImageUrl = function (imageUrl) {
               this.imageUrl = imageUrl;
               this.broadcastImage();
           };

           messageService.setMovieDescription = function (movieDescription) {
               this.movieDescription = movieDescription;
               this.broadcastContent();
           };

           messageService.setRating = function (movieRating) {
               this.movieRating = movieRating;
               this.broadcastRating();
           };

           messageService.loadAmazon = function () {
               this.broadcastAmazon();
           };

           messageService.loadSubjects = function () {
               this.broadcastSubjects();
           };


           messageService.loadSuggestions = function () {
               this.broadcastSuggestionTab();
           };


           messageService.loadMovieTab = function () {
               this.broadcastMovieTab();
           };


           messageService.hideSubjectVendorMaintenance = function () {
               $rootScope.$broadcast('handleBroadcastHideSubjectAndVendor');
           };

           messageService.showSubjectVendorMaintenance = function () {
               $rootScope.$broadcast('handleBroadcastHideSubjectAndVendorShow');
           };

           messageService.broadcastSubjects = function () {
               $rootScope.$broadcast('handleBroadCastSubjects');
           };

           messageService.broadcastImage = function () {
               $rootScope.$broadcast('handleBroadcastImage');
           };

           messageService.broadcastContent = function () {
               $rootScope.$broadcast('handleBroadcastContent');
           };

           messageService.broadcastItem = function () {
               $rootScope.$broadcast('handleBroadcast');
           };

           messageService.broadcastMovie = function () {
               $rootScope.$broadcast('handleMovieBroadcast');
           };

           messageService.broadcastFlixMovie = function () {
               $rootScope.$broadcast('handleFlixMovieBroadcast');
           };

           messageService.broadcastSuggestedMovie = function () {
               $rootScope.$broadcast('handleSuggestedMovieBroadcast');
           };

           messageService.broadcastOMDBMovie = function () {
               $rootScope.$broadcast('handleOMDBMovieBroadcast');
           };

           messageService.broadcastAmazon = function () {
               $rootScope.$broadcast('loadAmazon');
           };

           messageService.broadcastActor = function () {
               $rootScope.$broadcast('handleActor');
           };

           messageService.broadcastDirector = function () {
               $rootScope.$broadcast('handleDirector');
           };

           messageService.broadcastRating = function () {
               $rootScope.$broadcast('handleRating');
           };

           messageService.broadcastSuggestionTab = function () {
               $timeout(function () {
                   $rootScope.$broadcast('handleSuggestionTab');
               });
           };

           messageService.broadcastMovieTab = function () {
               $timeout(function () {
                   $rootScope.$broadcast('handleMovieTab');
               });
           };



           return messageService;
       })
      .service("flixMovieService", function ($http, $q) {

          this.getFlixMoviesByUrl = function (action) {
              var url = "api/flix_academy_admin_api.php?action=" + action + "&api_token=flixteam2014";
              $http.get(url).then(function (data) {
                  return data;
              });
          }


          //GetAllMovies
          var flixMoviesDeferred = $q.defer();
          $http.get('api/flix_academy_admin_api.php?action=getFlixMovies&api_token=flixteam2014').then(function (data) {
              flixMoviesDeferred.resolve(data);
          });


          this.getFlixMovies = function () {
              return flixMoviesDeferred.promise;
          }

          /*
          var flixSuggestionsDeferred = $q.defer();
          $http.get('api/flix_academy_admin_api.php?action=getSuggestions&api_token=flixteam2014').then(function (data) {
          flixSuggestionsDeferred.resolve(data);
          });

          this.getFlixSuggestions = function () {
          return flixSuggestionsDeferred.promise;
          }  */

          var flixVendorsDeferred = $q.defer();
          $http.get('api/flix_academy_admin_api.php?action=getVendors&api_token=flixteam2014').then(function (data) {
              flixVendorsDeferred.resolve(data);
          });

          this.getFlixVendors = function () {
              return flixVendorsDeferred.promise;
          }


          this.updateSuggestion = function (productsuggestion_id, product_id, approved, approved_date, approved_by) {
              $http.post("db/updateSuggestion.php", {
                  productsuggestion_id: productsuggestion_id,
                  product_id: product_id,
                  approved: approved,
                  approved_date: approved_date,
                  approved_by: approved_by
              })
          .success(function (data, status, headers, config) {
              //alert(suggestion_id + " marked approved"); //data.data(0).movieStatus(0).status                           
          }).error(function (data, status, headers, config) {
              alert("error!");
          });

          };


      })
      .service('googleService', ['$http', '$rootScope', '$q', function ($http, $rootScope, $q) {

          var APIKEY = "AIzaSyCaOmo_fJl5F3AyLttAdXgVMQOs8sc8pzM";

          var deferred = $q.defer();

          // Upon loading, the Google APIs JS client automatically invokes this callback.
          this.googleApiClientReady = function () {
              alert("googleApiClientReady");
              gapi.client.setApiKey(APIKEY);
              gapi.auth.init(function () {
                  alert("auth");
                  window.setTimeout(this.loadAPIClientInterfaces, 1);
              });
          };

          this.test = function () {
              alert(APIKEY);
          };


          this.loadAPIClientInterfaces = function () {
              gapi.client.load('youtube', 'v3', function () {

                  var request = gapi.client.youtube.search.list({
                      part: 'snippet',
                      channelId: 'UCqhNRDQE_fqBDBwsvmT8cTg',
                      order: 'date',
                      type: 'video'

                  });

                  request.execute(function (response) {
                      deferred.resolve(data);

                  });
              });

              return deferred.promise;
          };

      } ])

  .controller("flixSuggestionCtrl", function ($scope, $http, flixMovieService, mMessageService) {


      mMessageService.loadSubjects();

      /*
      var promise = flixMovieService.getFlixSuggestions();
      promise.then(function (data){
      $scope.movies = data.data;        
      mMessageService.loadSubjects();
      });  */

      $scope.$on('handleSuggestionTab', function () {
          $scope.getFlixSuggestionsByUrl('api/flix_academy_admin_api.php?action=getSuggestions&api_token=flixteam2014');
      });

      $scope.broadcastSuggestedMovie = function (suggestedMovie) {
          mMessageService.prepSuggestedMovieForBroadcast(suggestedMovie);
      };

      $scope.getFlixSuggestionsByUrl = function (url) {
          $scope.movies = null;
          $http.get(url).then(function (data) {
              $scope.movies = data.data;
          });
      };


      $scope.markSelected = function (approvalID) {
          if ($scope.movies != null) {
              angular.forEach($scope.movies, function (movie) {
                  if (movie.selected) {

                      var id = -1;
                      var flixID = -1;

                      if (!angular.isUndefined(movie._id)) {
                          id = movie._id
                      }

                      if (!angular.isUndefined(movie.flixID)) {
                          flixID = movie.flixID
                      }

                      $scope.markApproved(id, flixID, approvalID);
                  }
              });

              $scope.getFlixSuggestionsByUrl('api/flix_academy_admin_api.php?action=getSuggestions&api_token=flixteam2014');
          }
      };

      $scope.markApproved = function (productsuggestion_id, flixID, approvalID) {
          if (productsuggestion_id > -1) {
              flixMovieService.updateSuggestion(
                    productsuggestion_id,
                    flixID,
                    approvalID,
                    '00000000',
                    'flixAdmin');

          }
      };

      $scope.filterChanged = function () {

          var value = $scope.selectedFilter;

          if (value == 1) {
              $scope.getFlixSuggestionsByUrl('api/flix_academy_admin_api.php?action=getSuggestions&api_token=flixteam2014');
          } else if (value == 2) {
              $scope.getFlixSuggestionsByUrl('api/flix_academy_admin_api.php?action=getExistingSuggestions&api_token=flixteam2014');
          } else if (value == 3) {
              //$scope.getFlixMoviesByUrl('getMissingSubjectMovies');
          } else if (value == 4) {
              //$scope.getFlixCustomList('product_image LIKE \'\'');
          } else if (value == 5) {
              //$scope.getFlixCustomList('description LIKE \'\'');
          } else {

          }
      };


  })
  .controller("flixMovieCtrl", function ($scope, $state, $http, $filter, $window, $rootScope, movieService, flixMovieService, mMessageService) {

      $scope.$state = $state;

      /*
      var promise = flixMovieService.getFlixMovies();
      promise.then(function (data) {
      $scope.movies = data.data.movies;
      $scope.loadSubjects();
      $scope.loadVendors();
      });
      */

      $scope.$on('handleMovieTab', function () {
          $scope.getFlixMoviesByUrl('getFlixMovies');
          $scope.loadSubjects();
      });

      $scope.loadSubjects = function () {
          var url = "api/flix_academy_admin_api.php?action=getSubjects&api_token=flixteam2014";
          $http.get(url).then(function (data) {
              $scope.flixSubjects = data.data.subjects;
          });
      };

      $scope.loadVendors = function () {
          var url = "api/flix_academy_admin_api.php?action=getVendors&api_token=flixteam2014";
          $http.get(url).then(function (data) {
              $scope.vendors = data.data.vendors;
          });
      };

      $scope.loadMovie = function (movie) {
          movieService.set(movie);
          $state.go('movie_maintenance');
      };

      $scope.hasValue = function (item) {
          if (item.length > 0) {
              return item;
          } else {
              return null;
          }
      };


      $scope.filterChanged = function () {

          var value = $scope.selectedFilter;

          if (value == 1) {
              $scope.getFlixMoviesByUrl('getFlixMovies');
          } else if (value == 2) {
              $scope.getFlixMoviesByUrl('getMissingLinkMovies');
          } else if (value == 3) {
              $scope.getFlixMoviesByUrl('getMissingSubjectMovies');
          } else if (value == 4) {
              $scope.getFlixCustomList('product_image LIKE \'\'');
          } else if (value == 5) {
              $scope.getFlixCustomList('description LIKE \'\'');
          } else {

          }
      };

      $scope.subjectSelected = function () {

          var value = $scope.selectedSubjectID;

          if (value == 1) {
              $scope.getFlixMoviesByUrl('getFlixMovies');
          } else if (value == 2) {
              $scope.getFlixMoviesByUrl('getMissingLinkMovies');
          } else if (value == 3) {
              $scope.getFlixMoviesByUrl('getMissingSubjectMovies');
          } else if (value == 4) {
              $scope.getFlixCustomList('product_image LIKE \'\'');
          } else if (value == 5) {
              $scope.getFlixCustomList('description LIKE \'\'');
          } else {

          }
      };

      $scope.addSubject = function (movie, position, intSubject_id) {
          $http.post("db/addSubject.php", {
              product_id: movie.product_id,
              subject_id: intSubject_id
          })
            .success(function (data, status, headers, config) {
                $scope.getFlixMovie(movie.product_id, position);
            }).error(function (data, status, headers, config) {
                alert("error!");
            });

      };


      $scope.getFlixMovie = function (product_id, position) {
          var url = "api/flix_academy_admin_api.php?action=getFlixMovie&api_token=flixteam2014&product_id=" + product_id;
          $http.get(url).then(function (data) {
              $scope.movies[position] = data.data.movies[0];
              //$scope.movies[position].subjectID = -1;
          });
      };

      $scope.removeSubject = function (movie, position, intSubject_id) {
          $http.post("db/removeSubject.php", {
              product_id: movie.product_id,
              subject_id: intSubject_id
          })
        .success(function (data, status, headers, config) {
            //alert("subject added for " + mMessageService.movie.title); //data.data(0).movieStatus(0).status 
            $scope.getFlixMovie(movie.product_id, position);
        }).error(function (data, status, headers, config) {
            alert("error!");
        });


      };

      $scope.addVendor = function (movie, position, vendorId, vendorName, link_url) {
          //alert("TRYING " + vendorName + " url linked to movie " + link_url + " using vendor id# " + vendorId);
          $http.post("db/addVendorLink.php", {
              product_id: movie.product_id,
              vendor_id: vendorId,
              vendor_product_link: link_url,
              vendor_price: 0,
              vendor_isFree: 0,
              use_search: 0
          })
        .success(function (data, status, headers, config) {
            //alert(vendorName + " url linked to movie " + link_url + " using vendor id# " + vendorId); //data.data(0).movieStatus(0).status
            $scope.getFlixMovie(movie.product_id, position);
            $scope.vendorID = -1;
            $scope.vendorLinkUrl = '';
        }).error(function (data, status, headers, config) {
            alert("error!");
        });

      };

      $scope.removeVendor = function (movie, position, vendorId) {
          //alert("TRYING " + vendorName + " url linked to movie " + link_url + " using vendor id# " + vendorId);
          $http.post("db/removeVendorLink.php", {
              product_id: movie.product_id,
              vendor_id: vendorId
          })
        .success(function (data, status, headers, config) {
            //alert(vendorName + " url linked to movie " + link_url + " using vendor id# " + vendorId); //data.data(0).movieStatus(0).status
            $scope.getFlixMovie(movie.product_id, position);
        }).error(function (data, status, headers, config) {
            alert("error!");
        });

      };


      $scope.getFlixMoviesByUrl = function (action) {
          //alert(action);
          var url = "api/flix_academy_admin_api.php?action=" + action + "&api_token=flixteam2014";
          $http.get(url).then(function (data) {
              //alert("data Recvd");
              $scope.movies = null;
              $scope.movies = data.data.movies;
          });
      };

      $scope.getFlixCustomList = function (where) {
          var url = "api/flix_academy_admin_api.php?action=getCustomList&api_token=flixteam2014&where=" + where;
          $http.get(url).then(function (data) {
              //alert("data Recvd");
              $scope.movies = null;
              $scope.movies = data.data.movies;
          });
      };
      
      $scope.loadSubjects();
      $scope.loadVendors();

  })
  .controller("flixMissingLinksCtrl", function ($scope, flixMovieService, mMessageService) {

      var promise = flixMovieService.getFlixMissingLinx();
      promise.then(function (data) {
          $scope.movies = data.data.movies;
      });

      $scope.loadMovie = function (movie) {
          mMessageService.prepMovieForBroadcast(movie);
      };

  })
  .controller("flixMissingSubjectsCtrl", function ($scope, flixMovieService, mMessageService) {

      var promise = flixMovieService.getFlixMissingSubjects();
      promise.then(function (data) {
          $scope.movies = data.data.movies;
      });

      $scope.loadMovie = function (movie) {
          mMessageService.prepMovieForBroadcast(movie);
      };

  })
      .controller("flixRemixCtrl", function ($scope, $http, flixMovieService, mMessageService) {

          $scope.hours = ["00", "01", "02", "03", "04", "05"];

          $scope.hours = ["00", "01", "02", "03", "04", "05"];

          $scope.minutes = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10",
                            "11", "12", "13", "14", "15", "16", "17", "18", "19", "20",
                            "21", "22", "23", "24", "25", "26", "27", "28", "29", "30",
                            "31", "32", "33", "34", "35", "36", "37", "38", "39", "40",
                            "41", "42", "43", "44", "45", "46", "47", "48", "49", "50",
                            "51", "52", "53", "54", "55", "56", "57", "58", "59", "60"];

          $scope.seconds = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10",
                            "11", "12", "13", "14", "15", "16", "17", "18", "19", "20",
                            "21", "22", "23", "24", "25", "26", "27", "28", "29", "30",
                            "31", "32", "33", "34", "35", "36", "37", "38", "39", "40",
                            "41", "42", "43", "44", "45", "46", "47", "48", "49", "50",
                            "51", "52", "53", "54", "55", "56", "57", "58", "59", "60"];

          $scope.timeHR = "00";
          $scope.timeMIN = "00";
          $scope.timeSEC = "00";

          $scope.initialValue = 28;

          $scope.entryID = 1;
          $scope.entries = [];

          $scope.addEntry = function (entry) {
              $scope.entries.push(entry);
          };

          $scope.getMinutes = function () {

              var min = "" + $scope.timeMIN;

              if ($scope.timeMIN < 10) {
                  min = "0" + $scope.timeMIN;
              };

              return min;

          };

          $scope.getSeconds = function () {

              var sec = "" + $scope.timeSEC;

              if ($scope.timeSEC < 10) {
                  sec = "0" + $scope.timeSEC;
              };

              return sec;

          };

          $scope.getEntry = function () {

              var entry =
                  {
                      "id": $scope.entryID++,
                      "time": $scope.timeHR + ":" + $scope.timeMIN + ":" + $scope.timeSEC,
                      "commentary": $scope.commentary,
                      "link": $scope.link,
                      "image": $scope.image
                  };

              return entry;

          };

          $scope.saveExit = function () {
              alert("Saving...")
          };

          $scope.addMore = function () {
              $scope.addEntry($scope.getEntry());
              $scope.remixEntries = $scope.entries;
          };

          $scope.changeTime = function () {
              $scope.time = $scope.timeProgress;
          };

          //flix movie     
          $scope.$on('handleFlixMovieBroadcast', function () {
              $scope.getFlixMovie(mMessageService.product_id);
          });


          $scope.getFlixMovie = function (product_id) {
              var url = "api/flix_academy_admin_api.php?action=getFlixMovie&api_token=flixteam2014&product_id=" + product_id;
              $http.get(url).then(function (data) {

                  var _movie = data.data.movies[0];

                  var tempMovie =
                  {
                      "Title": _movie.title,
                      "Year": _movie.release_year,
                      "Rated": _movie.rating,
                      "Released": _movie.release_date,
                      "Runtime": _movie.length,
                      "Genre": '',
                      "Director": _movie.director,
                      "Writer": _movie.writer,
                      "Actors": _movie.actors,
                      "Plot": _movie.description,
                      "Language": _movie.language,
                      "Country": _movie.country,
                      "Awards": _movie.awards,
                      "Poster": _movie.product_image,
                      "Metascore": '',
                      "Imdbrating": '',
                      "Imdbvotes": '',
                      "imdbID": _movie.imdb_id,
                      "Type": _movie.type,
                      "isFlix": true,
                      "product_id": _movie.product_id,
                      "SuggestedBy": '',
                      "suggestion_id": -1,
                      "subjects": _movie.subjects,
                      "vendors": _movie.vendors
                  };


                  $scope.loadMovie(tempMovie);

              });
          };

          //from omdb or flix - may need to tweak
          $scope.loadMovie = function (movie) {

              mMessageService.movie = movie;
              mMessageService.message = movie.Title;
              mMessageService.product_id = movie.product_id;

              //$scope.loadSubjects();

              $scope.movieTitle = movie.Title;
              $scope.coverArt = movie.Poster;
              $scope.movieRuntime = movie.Runtime;

              /*
              $scope.movieTitle = movie.Title;
              $scope.movieYear = movie.Year;
              $scope.movieRated = movie.Rated;
              $scope.movieReleased = movie.Released;
              $scope.movieRuntime = movie.Runtime;
              $scope.movieGenre = movie.Genre;
              $scope.movieDirector = movie.Director;
              $scope.movieWriter = movie.Writer;
              $scope.movieActors = movie.Actors;
              $scope.moviePlot = movie.Plot;
              $scope.movieLanguage = movie.Language;
              $scope.movieCountry = movie.Country;
              $scope.movieAwards = movie.Awards;
              $scope.moviePoster = movie.Poster;
              $scope.coverArt = movie.Poster;
              $scope.movieMetascore = movie.Metascore;
              $scope.movieimdbRating = movie.imdbRating;
              $scope.movieImdbvotes = movie.imdbVotes;
              $scope.movieimdbID = movie.imdbID;
              $scope.movieType = movie.Type;
              $scope.coverArtChecked = true;
          
        
              $scope.movieSuggestionID = movie.suggestion_id;
              $scope.movieSuggestedBy = movie.SuggestedBy;
              $scope.movieflix_id = movie.product_id; 
          
          
              if(movie.isFlix){
              $scope.subjects = movie.subjects;
              $scope.vendors = movie.vendors;           
              $scope.coverArt = _movie.product_image;
              mMessageService.showSubjectVendorMaintenance;
              } else {     
              $scope.coverArt = "http://img.omdbapi.com/?i=" + movie.imdbID + "&apikey=18deef75"; 
              mMessageService.hideSubjectVendorMaintenance;
              }
        
        
              */

          }

      })

      
    .controller("newMovieMaintenanceCtrl", function ($scope, $http, $sce, $state, $window, $rootScope, movieService, mMessageService, flixMovieService) {

      $scope.$on('$stateChangeSuccess', function () {
          // do something
          var movie = movieService.get();
          if (movie != null) {
              $scope.loadFlixMovie(movie);
          }
      });

      $scope.loadFlixMovie = function (_movie) {

              var tempMovie =
                  {
                      "Title": _movie.title,
                      "Year": _movie.release_year,
                      "Rated": _movie.rating,
                      "Released": _movie.release_date,
                      "Runtime": _movie.length,
                      "Genre": '',
                      "Director": _movie.director,
                      "Writer": _movie.writer,
                      "Actors": _movie.actors,
                      "Plot": _movie.description,
                      "Language": _movie.language,
                      "Country": _movie.country,
                      "Awards": _movie.awards,
                      "Poster": _movie.product_image,
                      "Metascore": '',
                      "Imdbrating": '',
                      "Imdbvotes": '',
                      "imdbID": _movie.imdb_id,
                      "Type": _movie.type,
                      "isFlix": true,
                      "product_id": _movie.product_id,
                      "SuggestedBy": '',
                      "suggestion_id": -1,
                      "subjects": _movie.subjects,
                      "vendors": _movie.vendors
                  };


              $scope.loadMovie(tempMovie);

      };

      //from omdb or flix - may need to tweak
      $scope.loadMovie = function (movie) {

          mMessageService.movie = movie;
          mMessageService.message = movie.title;
          mMessageService.product_id = movie.product_id;

          //$scope.loadSubjects();

          $scope.movieTitle = movie.Title;
          $scope.movieYear = movie.Year;
          $scope.movieRated = movie.Rated;
          $scope.movieReleased = movie.Released;
          $scope.movieRuntime = movie.Runtime;
          $scope.movieGenre = movie.Genre;
          $scope.movieDirector = movie.Director;
          $scope.movieWriter = movie.Writer;
          $scope.movieActors = movie.Actors;
          $scope.moviePlot = movie.Plot;
          $scope.movieLanguage = movie.Language;
          $scope.movieCountry = movie.Country;
          $scope.movieAwards = movie.Awards;
          $scope.moviePoster = movie.Poster;
          $scope.coverArt = movie.Poster;
          $scope.movieMetascore = movie.Metascore;
          $scope.movieimdbRating = movie.imdbRating;
          $scope.movieImdbvotes = movie.imdbVotes;
          $scope.movieimdbID = movie.imdbID;
          $scope.movieType = movie.Type;
          $scope.coverArtChecked = true;

          $scope.movieSuggestionID = movie.suggestion_id;
          $scope.movieSuggestedBy = movie.SuggestedBy;
          $scope.movieflix_id = movie.product_id;


          if (movie.isFlix) {
              $scope.subjects = movie.subjects;
              $scope.vendors = movie.vendors;
              $scope.coverArt = _movie.product_image;
              mMessageService.showSubjectVendorMaintenance;
          } else {
              $scope.coverArt = "http://img.omdbapi.com/?i=" + movie.imdbID + "&apikey=18deef75";
              mMessageService.hideSubjectVendorMaintenance;
          }

      }


  })
  .controller("movieMaintenanceCtrl", function ($scope, $http, $sce, $state, $window, $rootScope, movieService, mMessageService, flixMovieService) {

      $scope.$state = $state;

      $scope.$on('$stateChangeSuccess', function () {
          // do something
          var movie = movieService.get();
          if (movie != null) {
              $scope.loadFlixMovie(movie);
          }
      });

      $scope.showMaintenance = function () {

          var isFlixMovie = false;
          if (mMessageService.movie.product_id > 0) {
              isFlixMovie = true;
          }

          return isFlixMovie;
      };

      $scope.getData = function (title) {
          var omdbapi = "http://www.omdbapi.com/?&y=&plot=full&r=json&tomatoes=true&t=" + title.replace(' ', '%20');
          $http.get(omdbapi).then(function (data) {
              $scope.movies = data;
          });
      };

      $scope.loadSubjects = function () {
          var url = "api/flix_academy_admin_api.php?action=getSubjects&api_token=flixteam2014";
          $http.get(url).then(function (data) {
              $scope.flixSubjects = data.data.subjects;
              $scope.selectedSubjectID = -1;
          });
      };

      $scope.makeIMDBUrl = function (imdbID) {
          return "http://www.imdb.com/title/" + imdbID;
      };

      $scope.toggleView = function (view) {
          view = !view;
      };

      $scope.isInteger = function (value) {
          return !isNaN(value) &&
                   parseInt(Number(value)) == value &&
                   !isNaN(parseInt(value, 10));
      };

      $scope.isInt = function (x) {
          return parseInt(x, 10) === x;
      };

      $scope.isNumeric = function (num) {
          return !isNaN(num);
      };

      $scope.btnDeleteMovie = function () {

          if (confirm("are you sure you wnat to delete " + $scope.movieTitle + " from Flix Academy") == true) {
              $http.post("db/deleteMovie.php", { product_id: mMessageService.movie.product_id })
        .success(function (data, status, headers, config) {
            alert($scope.movieTitle + " deleted from Flix Academy"); //data.data(0).movieStatus(0).status                           
        }).error(function (data, status, headers, config) {
            alert("error!");
        });
          } else {
              alert($scope.movieTitle + " will remain on Flix Academy");
          }
      };

      $scope.btnSaveUpdate = function () {

          if (mMessageService.movie.product_id == null) {
              $scope.saveToFlix();
          } else if ($scope.isNumeric(mMessageService.movie.product_id)) {
              $scope.updateFlix(mMessageService.movie.product_id);
          } else {
              $scope.saveToFlix();
          }
      };

      $scope.updateFlix = function (productId) {

          var slength = $scope.movieRuntime;
          var iLength = 0;
          var length = "";

          if ($scope.isNumeric(slength)) {
              iLength = slength;
          } else {
              length = slength.replace(/[^0-9]/g, '');
              if ($scope.isNumeric(length)) {
                  iLength = length;
              }
          }

          $http.post("db/updateMovie.php", {
              product_id: productId,
              title: $scope.movieTitle,
              rating: $scope.movieRated,
              release_date: '00000000', //$scope.movieReleased, get date format
              release_year: $scope.movieYear,
              length: iLength,
              description: $scope.moviePlot,
              status_id: '1',
              age_min: '0',
              age_max: '0', // get age
              product_image: $scope.coverArt,
              country: $scope.movieCountry,
              language: $scope.movieLanguage,
              actors: $scope.movieActors,
              director: $scope.movieDirector,
              writer: $scope.movieWriter,
              awards: $scope.movieAwards,
              type: '1',
              imdb_id: $scope.movieimdbID
          })
        .success(function (data, status, headers, config) {
            alert($scope.movieTitle + " updated on Flix Academy"); //data.data(0).movieStatus(0).status 

            $state.reload();
            $scope.getFlixMovie(productId);

        }).error(function (data, status, headers, config) {
            alert("error!");
        });

      };



      $scope.saveToFlix = function () {

          if ($scope.isNumeric($scope.movieSuggestionID)) {
              suggestion_id = parseInt($scope.movieSuggestionID);
          }

          var slength = $scope.movieRuntime;
          var iLength = 0;
          var length = "";

          if ($scope.isNumeric(slength)) {
              iLength = slength;
          } else {
              length = slength.replace(/[^0-9]/g, '');
              if ($scope.isNumeric(length)) {
                  iLength = length;
              }
          }

          $http.post("db/addMovie.php", {
              title: $scope.movieTitle,
              rating: $scope.movieRated,
              release_date: '00000000', //$scope.movieReleased, get date format
              release_year: $scope.movieYear,
              length: iLength,
              description: $scope.moviePlot,
              status_id: '1',
              age_min: '0',
              age_max: '0', // get age
              product_image: $scope.coverArt,
              country: $scope.movieCountry,
              language: $scope.movieLanguage,
              actors: $scope.movieActors,
              director: $scope.movieDirector,
              writer: $scope.movieWriter,
              awards: $scope.movieAwards,
              type: '1',
              imdb_id: $scope.movieimdbID
          })
        .success(function (data, status, headers, config) {

            var newProductID = data;

            var suggestion_id = -1;

            if ($scope.isNumeric($scope.movieSuggestionID)) {
                suggestion_id = parseInt($scope.movieSuggestionID);
            }

            if (suggestion_id > -1) {
                flixMovieService.updateSuggestion(
                    suggestion_id,
                    newProductID,
                    1,
                    '00000000',
                    'flixAdmin');
            }

            alert($scope.movieTitle + " saved to Flix Academy");

            //$state.reload();
            $scope.getFlixMovie(newProductID);

        }).error(function (data, status, headers, config) {
            alert("error!");
        });


      };

      $scope.getAmazonImage = function (search) {
          var url = "api/search_api.php?action=getAmazonData&search=" + search;
          $http.get(url).then(function (data) {
              //$scope.data = data;
              //$scope.amazons = data.data.results;
              if (data.data.results.length > 0) {
                  $scope.coverArtChecked = true;
                  $scope.coverArt = data.data.results[0].image_url;
              } else {
                  $scope.coverArtChecked = false;
                  $scope.coverArt = "";
              }

          });
      };

      $scope.getSubjects = function (product_id) {
          var url = "api/flix_academy_admin_api.php?action=getSubjectsByMovie&api_token=flixteam2014&product_id=" + product_id;
          $http.get(url).then(function (data) {
              $scope.subjects = data.data.subjects;
          });
      };


      $scope.removeSubject = function (subjectID) {
          $http.post("db/removeSubject.php", {
              product_id: mMessageService.product_id,
              subject_id: subjectID
          })
        .success(function (data, status, headers, config) {
            //alert("subject added for " + mMessageService.movie.title); //data.data(0).movieStatus(0).status 
            $scope.getFlixMovie(mMessageService.product_id);
        }).error(function (data, status, headers, config) {
            alert("error!");
        });


      };

      $scope.subjectSelected = function () {
          $http.post("db/addSubject.php", {
              product_id: mMessageService.product_id,
              subject_id: $scope.selectedSubjectID
          })
        .success(function (data, status, headers, config) {
            //alert("subject added for " + mMessageService.movie.title); //data.data(0).movieStatus(0).status 
            $scope.getFlixMovie(mMessageService.product_id);
        }).error(function (data, status, headers, config) {
            alert("error!");
        });

      };

      $scope.getVendors = function (product_id) {
          var url = "api/flix_academy_admin_api.php?action=getVendorsByMovie&api_token=flixteam2014&product_id=" + product_id;
          $http.get(url).then(function (data) {
              $scope.vendors = data.data.vendors;
          });
      };

      $scope.initForm = function (title) {

          var tempMovie =
                  {
                      "Title": title,
                      "Year": '',
                      "Rated": '',
                      "Released": '',
                      "Runtime": '',
                      "Genre": '',
                      "Director": '',
                      "Writer": '',
                      "Actors": '',
                      "Plot": '',
                      "Language": '',
                      "Country": '',
                      "Awards": '',
                      "Poster": '',
                      "Metascore": '',
                      "Imdbrating": '',
                      "Imdbvotes": '',
                      "imdbID": '',
                      "Type": '',
                      "isFlix": false,
                      "product_id": '',
                      "SuggestedBy": '',
                      "suggestion_id": -1
                  };

          var movies = new Array();
          movies[0] = tempMovie;
          $scope.movieTitle = title;
          $scope.amazons = "";
          $scope.movies = movies;
          $scope.getAmazonImage(title.replace(' ', '%20'));

          //mMessageService.loadSubjects();


      };

      $scope.initForm = function () {

          $scope.movieTitle = '';
          $scope.movieYear = '';
          $scope.movieRated = '';
          $scope.movieReleased = '';
          $scope.movieRuntime = '';
          $scope.movieGenre = '';
          $scope.movieDirector = '';
          $scope.movieWriter = '';
          $scope.movieActors = '';
          $scope.moviePlot = '';
          $scope.movieLanguage = '';
          $scope.movieCountry = '';
          $scope.movieAwards = '';
          $scope.moviePoster = '';
          $scope.coverArt = '';
          $scope.coverArtChecked = false;
          $scope.movieMetascore = '';
          $scope.movieimdbRating = '';
          $scope.movieImdbvotes = '';
          $scope.movieimdbID = '';
          $scope.movieType = '';
          $scope.movieSuggestionID = '';
          $scope.movieSuggestedBy = '';
          $scope.movieflix_id = '';
          $scope.movieSuggestionID = '';
          $scope.movieSuggestedBy = '';
          $scope.subjects = '';


          //$scope.subjects = null;
          $scope.vendors = '';

      };

      $scope.getFlixMovie = function (product_id) {
          var url = "api/flix_academy_admin_api.php?action=getFlixMovie&api_token=flixteam2014&product_id=" + product_id;
          $http.get(url).then(function (data) {

              var _movie = data.data.movies[0];

              var tempMovie =
                  {
                      "Title": _movie.title,
                      "Year": _movie.release_year,
                      "Rated": _movie.rating,
                      "Released": _movie.release_date,
                      "Runtime": _movie.length,
                      "Genre": '',
                      "Director": _movie.director,
                      "Writer": _movie.writer,
                      "Actors": _movie.actors,
                      "Plot": _movie.description,
                      "Language": _movie.language,
                      "Country": _movie.country,
                      "Awards": _movie.awards,
                      "Poster": _movie.product_image,
                      "Metascore": '',
                      "Imdbrating": '',
                      "Imdbvotes": '',
                      "imdbID": _movie.imdb_id,
                      "Type": _movie.type,
                      "isFlix": true,
                      "product_id": _movie.product_id,
                      "SuggestedBy": '',
                      "suggestion_id": -1,
                      "subjects": _movie.subjects,
                      "vendors": _movie.vendors
                  };


              $scope.loadMovie(tempMovie);

          });
      };

      $scope.loadFlixMovie = function (_movie) {

              var tempMovie =
                  {
                      "Title": _movie.title,
                      "Year": _movie.release_year,
                      "Rated": _movie.rating,
                      "Released": _movie.release_date,
                      "Runtime": _movie.length,
                      "Genre": '',
                      "Director": _movie.director,
                      "Writer": _movie.writer,
                      "Actors": _movie.actors,
                      "Plot": _movie.description,
                      "Language": _movie.language,
                      "Country": _movie.country,
                      "Awards": _movie.awards,
                      "Poster": _movie.product_image,
                      "Metascore": '',
                      "Imdbrating": '',
                      "Imdbvotes": '',
                      "imdbID": _movie.imdb_id,
                      "Type": _movie.type,
                      "isFlix": true,
                      "product_id": _movie.product_id,
                      "SuggestedBy": '',
                      "suggestion_id": -1,
                      "subjects": _movie.subjects,
                      "vendors": _movie.vendors
                  };


              $scope.loadMovie(tempMovie);

      };

      //from omdb or flix - may need to tweak
      $scope.loadMovie = function (movie) {

          mMessageService.movie = movie;
          mMessageService.message = movie.title;
          mMessageService.product_id = movie.product_id;

          $scope.loadSubjects();

          $scope.movieTitle = movie.Title;
          $scope.movieYear = movie.Year;
          $scope.movieRated = movie.Rated;
          $scope.movieReleased = movie.Released;
          $scope.movieRuntime = movie.Runtime;
          $scope.movieGenre = movie.Genre;
          $scope.movieDirector = movie.Director;
          $scope.movieWriter = movie.Writer;
          $scope.movieActors = movie.Actors;
          $scope.moviePlot = movie.Plot;
          $scope.movieLanguage = movie.Language;
          $scope.movieCountry = movie.Country;
          $scope.movieAwards = movie.Awards;
          $scope.moviePoster = movie.Poster;
          $scope.coverArt = movie.Poster;
          $scope.movieMetascore = movie.Metascore;
          $scope.movieimdbRating = movie.imdbRating;
          $scope.movieImdbvotes = movie.imdbVotes;
          $scope.movieimdbID = movie.imdbID;
          $scope.movieType = movie.Type;
          $scope.coverArtChecked = true;

          $scope.movieSuggestionID = movie.suggestion_id;
          $scope.movieSuggestedBy = movie.SuggestedBy;
          $scope.movieflix_id = movie.product_id;


          if (movie.isFlix) {
              $scope.subjects = movie.subjects;
              $scope.vendors = movie.vendors;
              $scope.coverArt = _movie.product_image;
              mMessageService.showSubjectVendorMaintenance;
          } else {
              $scope.coverArt = "http://img.omdbapi.com/?i=" + movie.imdbID + "&apikey=18deef75";
              mMessageService.hideSubjectVendorMaintenance;
          }

      }



      $scope.$on('handleBroadcastHideSubjectAndVendor', function () {

          $scope.showSubjectMaintenance = false;
          $scope.showVendorMaintenance = false;

      });


      $scope.$on('handleBroadcastHideSubjectAndVendorShow', function () {

          $scope.showSubjectMaintenance = true;
          $scope.showVendorMaintenance = true;

      });


      $scope.$on('handleBroadcast', function () {


          $scope.initForm();
          $scope.movieTitle = mMessageService.message;

          $scope.coverArtChecked = false;
          //$scope.getAmazonImage(mMessageService.message.replace(' ','%20'));

          var url = "http://www.omdbapi.com/?&y=&plot=full&r=json&tomatoes=true&t=" + mMessageService.message.replace(' ', '%20');
          $http.get(url).then(function (data) {

              if (data != null) {
                  angular.forEach(data, function (movie) {
                      if (movie.Title != null) {
                          movie.isFlix = false;
                          $scope.loadMovie(movie);
                      }
                  });

              } else {
                  $scope.initForm(title);
              }

          });
      });

      $scope.$on('handleOMDBMovieBroadcast', function () {
          $scope.loadMovie(mMessageService.movie);
      });


      $scope.$on('handleSuggestedMovieBroadcast', function () {

          var loaded = false;
          $scope.initForm();

          var _movie = mMessageService.movie;
          $scope.movieTitle = _movie.title;
          $scope.movieSuggestionID = _movie._id;
          $scope.movieSuggestedBy = _movie.submitted_by;


          var pattern = /^((http|https|ftp):\/\/)/;
          var url = _movie.title;
          var youtube = "youtube.com/watch?";

          //alert(url);

          if (pattern.test(url)) {
              //url = "http://" + url;

              if (url.indexOf(youtube) > 0) {
                  alert("youtube");
              }


              var win = $window.open(url, '_blank');
              win.focus();

          } else {
              var url = "http://www.omdbapi.com/?&y=&plot=full&r=json&tomatoes=true&t=" + _movie.title.replace(' ', '%20');
              $http.get(url).then(function (data) {

                  if (data != null) {
                      angular.forEach(data, function (movie) {
                          if (movie.Title != null && !loaded) {
                              loaded = true;
                              //this is still the omdb movie
                              movie.isFlix = false;
                              $scope.loadMovie(movie);
                              mMessageService.movie.isFlix = false;
                              mMessageService.movie.suggestion_id = _movie._id;
                              mMessageService.movie.SuggestedBy = _movie.submitted_by;
                              $scope.movieSuggestionID = _movie._id;
                              $scope.movieSuggestedBy = _movie.submitted_by;
                          }
                      });

                  } else {
                      $scope.initForm(title);
                  }

              });
          }
      });

      //flix movie     
      $scope.$on('handleFlixMovieBroadcast', function () {
          alert(mMessageService.product_id);
          $scope.getFlixMovie(mMessageService.product_id);
      });



      //flix movie     
      $rootScope.$on('flixMovieBroadcast', function (product_id) {
          alert(product_id);
          $scope.getFlixMovie(product_id);
      });



      $scope.$on('handleMovieBroadcast', function () {

          var _movie = mMessageService.movie;

          var tempMovie =
                  {
                      "Title": _movie.title,
                      "Year": _movie.release_year,
                      "Rated": _movie.rating,
                      "Released": _movie.release_date,
                      "Runtime": _movie.length,
                      "Genre": '',
                      "Director": _movie.director,
                      "Writer": _movie.writer,
                      "Actors": _movie.actors,
                      "Plot": _movie.description,
                      "Language": _movie.language,
                      "Country": _movie.country,
                      "Awards": _movie.awards,
                      "Poster": _movie.product_image,
                      "Metascore": '',
                      "Imdbrating": '',
                      "Imdbvotes": '',
                      "imdbID": _movie.imdb_id,
                      "Type": _movie.type,
                      "isFlix": true,
                      "product_id": _movie.product_id,
                      "SuggestedBy": '',
                      "suggestion_id": -1,
                      "subjects": _movie.subjects,
                      "vendors": _movie.vendors
                  };
          $scope.loadMovie(tempMovie);


      });

      $scope.$on('handleBroadcastImage', function () {
          $scope.coverArtChecked = true;
          var imageUrl = mMessageService.imageUrl;
          $scope.coverArt = imageUrl;
      });

      $scope.$on('handleBroadcastContent', function () {
          $scope.moviePlot = mMessageService.movieDescription;
      });


      $scope.$on('handleActor', function () {
          $scope.movieActors = mMessageService.actor;
      });

      $scope.$on('handleDirector', function () {
          $scope.movieDirector = mMessageService.director;
      });

      $scope.$on('handleRating', function () {
          $scope.movieRated = mMessageService.movieRating;
      });


  })
  .controller("searchCtrl", function ($scope, $http, mMessageService) {
      $scope.getData = function (msg) {
          mMessageService.prepForBroadcast(msg);
      };
  })
  .controller("tmdbCtrl", function ($scope, $http, mMessageService) {

      $scope.getApiKey = function () {
          var api_key = "3df16f151e0f0151549b8c3eab8c6b3c";
          return api_key;
      };

      $scope.getData = function () {
          $scope.getTMDBData(mMessageService.message);
      };

      $scope.getCustomData = function (search) {
          $scope.getTMDBData(search);
      };

      $scope.getTMDBData = function (title) {
          var url = "http://api.themoviedb.org/3/search/movie?query=" + title.replace("", "%20") + "?&api_key=" + $scope.getApiKey();
          var img_base_url = "http://image.tmdb.org/t/p/w500";
          var imageUrl = "";
          $http.get(url).then(function (data) {
              $scope.tmdbs = data.data.results;
              if (data != null) {
                  angular.forEach(data.data.results, function (movie) {
                      if (movie != null) {
                          $scope.getID(movie.id);
                      }
                  });
              }
          });
      };

      $scope.getID = function (id) {
          var url = "http://api.themoviedb.org/3/movie/" + id + "?&api_key=" + $scope.getApiKey();
          $http.get(url).then(function (data) {
              $scope.original_title = data.data.original_title;
              $scope.overview = data.data.overview;
              $scope.runtime = data.data.runtime;
              $scope.imdb_id = data.data.imdb_id;
              $scope.release_date = data.data.release_date;
          });
      };

      $scope.sendImage = function (imageUrl) {
          mMessageService.setImageUrl(imageUrl);
      };

      $scope.sendContent = function (editorialreview) {
          mMessageService.setMovieDescription(editorialreview);
      };

      $scope.sendActors = function (actor) {
          mMessageService.setActor(actor);
      };

      $scope.sendDirectors = function (director) {
          mMessageService.setDirector(director);
      };


  })
  .controller("rottenTomatoeCtrl", function ($scope, $http, mMessageService) {

      $scope.getApiKey = function () {
          var api_key = "6d5uzs87rcauk8pgrvhm774n";
          return api_key;
      };

      $scope.getData = function () {
          $scope.getRottenTomatoeData(mMessageService.message);
      };

      $scope.getCustomData = function (search) {
          $scope.getRottenTomatoeData(search);
      };

      $scope.getRottenTomatoeData = function (title) {
          $http.jsonp('http://api.rottentomatoes.com/api/public/v1.0/movies.json', {
              params: {
                  page_limit: '5',
                  page: '1',
                  q: title.replace(" ", "+"),
                  apikey: $scope.getApiKey(),
                  callback: 'JSON_CALLBACK'
              }
          })
          .success(function (data) {
              $scope.movies = data.movies;
          });
      };

      $scope.getID = function (id) {
          var url = "http://api.themoviedb.org/3/movie/" + id + "?&api_key=" + $scope.getApiKey();
          $http.get(url).then(function (data) {
              $scope.original_title = data.data.original_title;
              $scope.overview = data.data.overview;
              $scope.runtime = data.data.runtime;
              $scope.imdb_id = data.data.imdb_id;
              $scope.release_date = data.data.release_date;
          });
      };

      $scope.sendImage = function (imageUrl) {
          mMessageService.setImageUrl(imageUrl);
      };

      $scope.sendContent = function (editorialreview) {
          mMessageService.setMovieDescription(editorialreview);
      };

      $scope.sendActors = function (actor) {
          mMessageService.setActor(actor);
      };

      $scope.sendDirectors = function (director) {
          mMessageService.setDirector(director);
      };


  })
  .controller("amazonCtrl", function ($scope, $http, mMessageService) {

      $scope.getAmazonData = function () {
          var url = "api/search_api.php?action=getAmazonData&search=" + mMessageService.message.replace(" ", "%20");
          $http.get(url).then(function (data) {
              $scope.amazons = data.data.results;
          });
      };

      $scope.getAmazonCustomData = function (search) {
          var url = "api/search_api.php?action=getAmazonData&search=" + search.replace(" ", "%20");
          $http.get(url).then(function (data) {
              $scope.amazons = data.data.results;
          });
      };

      $scope.linkAmazon = function (amazon_url, vendorId) {

          var movie = mMessageService.movie;

          $http.post("db/addVendorLink.php", {
              product_id: movie.product_id,
              vendor_id: vendorId,
              vendor_product_link: amazon_url,
              vendor_price: 0,
              vendor_isFree: 0,
              use_search: 0
          })
        .success(function (data, status, headers, config) {
            alert("Amazon url linked to movie " + amazon_url + " using vendor id# " + vendorId); //data.data(0).movieStatus(0).status
            mMessageService.prepFlixMovieForBroadcast(mMessageService.product_id);
        }).error(function (data, status, headers, config) {
            alert("error!");
        });
      };


      $scope.sendImage = function (imageUrl) {
          mMessageService.setImageUrl(imageUrl);
      };

      $scope.sendContent = function (editorialreview) {
          mMessageService.setMovieDescription(editorialreview);
      };

      $scope.sendActors = function (actor) {
          mMessageService.setActor(actor);
      };

      $scope.sendDirectors = function (director) {
          mMessageService.setDirector(director);
      };

      $scope.sendRating = function (rating) {
          mMessageService.setRating(rating);
      };


      $scope.$on('loadAmazon', function () {
          $scope.amazons = "";
          $scope.getAmazonData();
      });


  })

  .controller("googleCtrl", function ($scope, $http, mMessageService) {

      var imageSearch;

      $scope.addPaginationLinks_OLD = function () {

          // To paginate search results, use the cursor function.
          var cursor = imageSearch.cursor;
          var curPage = cursor.currentPageIndex; // check what page the app is on
          var pagesDiv = document.createElement('div');
          for (var i = 0; i < cursor.pages.length; i++) {
              var page = cursor.pages[i];
              if (curPage == i) {

                  // If we are on the current page, then don't make a link.
                  var label = document.createTextNode(' ' + page.label + ' ');
                  pagesDiv.appendChild(label);
              } else {

                  // Create links to other pages using gotoPage() on the searcher.
                  var link = document.createElement('a');
                  link.href = "/image-search/v1/javascript:imageSearch.gotoPage(" + i + ');';
                  link.innerHTML = page.label;
                  link.style.marginRight = '2px';
                  pagesDiv.appendChild(link);
              }
          }

          //var contentDiv = document.getElementById('content');
          //contentDiv.appendChild(pagesDiv);
      };

      $scope.addPaginationLinks = function () {

          // To paginate search results, use the cursor function.
          var cursor = imageSearch.cursor;
          var curPage = cursor.currentPageIndex; // check what page the app is on
          var pagesDiv = document.createElement('div');
          for (var i = 0; i < cursor.pages.length; i++) {
              var page = cursor.pages[i];
              if (curPage == i) {

                  // If we are on the current page, then don't make a link.
                  var label = document.createTextNode(' ' + page.label + ' ');
                  pagesDiv.appendChild(label);
              } else {

                  // Create links to other pages using gotoPage() on the searcher.
                  var link = document.createElement('a');
                  link.href = "/image-search/v1/javascript:imageSearch.gotoPage(" + i + ');';
                  link.innerHTML = page.label;
                  link.style.marginRight = '2px';
                  pagesDiv.appendChild(link);
              }
          }

          //var contentDiv = document.getElementById('content');
          //contentDiv.appendChild(pagesDiv);
      };


      $scope.searchComplete = function () {

          // Check that we got results
          if (imageSearch.results && imageSearch.results.length > 0) {
              $scope.googles = imageSearch.results;
          }
          // Now add links to additional pages of search results.
          $scope.addPaginationLinks(imageSearch);

      }

      $scope.getData = function () {
          // Create an Image Search instance.

          imageSearch = new google.search.ImageSearch();
          // Set searchComplete as the callback function when a search is 
          // complete.  The imageSearch object will have results in it.
          imageSearch.setSearchCompleteCallback(this, $scope.searchComplete, null);

          // Find me a beautiful car.
          imageSearch.execute(mMessageService.message);

          // Include the required Google branding
          //google.search.Search.getBranding('branding');
          //alert('4');
      }





      $scope.getData2 = function () {
          var url = "api/search_api.php?action=getGoogleImages&search=movie%2012" + mMessageService.message;
          $http.get(url).then(function (data) {
              $scope.googles = data.data.responseData.results;
          });
      };


      $scope.sendImage = function (imageUrl) {
          mMessageService.setImageUrl(imageUrl);
      };

      $scope.sendContent = function (editorialreview) {
          mMessageService.setMovieDescription(editorialreview);
      };

      $scope.sendActors = function (actor) {
          mMessageService.setActor(actor);
      };

      $scope.sendDirectors = function (director) {
          mMessageService.setDirector(director);
      };
  })

  .controller("googleCtrlBackUp", function ($scope, $http, mMessageService) {

      $scope.getData = function () {
          var url = "api/search_api.php?action=getGoogleImages&search=movie%20" + mMessageService.message;
          $http.get(url).then(function (data) {
              $scope.googles = data.data.responseData.results;
          });
      };


      $scope.sendImage = function (imageUrl) {
          mMessageService.setImageUrl(imageUrl);
      };

      $scope.sendContent = function (editorialreview) {
          mMessageService.setMovieDescription(editorialreview);
      };

      $scope.sendActors = function (actor) {
          mMessageService.setActor(actor);
      };

      $scope.sendDirectors = function (director) {
          mMessageService.setDirector(director);
      };
  })
  .controller("youTubeCtrl", function ($scope, $http, mMessageService, googleService) {


      var promise = googleService.loadAPIClientInterfaces();
      promise.then(function (data) {
          alert("youtubeCtrl");
          $scope.googles = data.data.data
      });

      $scope.getData = function () {
          alert("getData");
          var promise = googleService.loadAPIClientInterfaces();
          promise.then(function (data) {
              alert("youtubeCtrl2");
              //$scope.googles = data.data.data.items;
          });
      };


      $scope.getData2 = function () {
          var url = "api/search_api.php?action=getYouTubeVideos&search=" + mMessageService.message;
          $http.get(url).then(function (data) {
              //$scope.data = data.data.data.items;
              $scope.googles = data.data.data.items;
          });
      };

      $scope.sendImage = function (imageUrl) {
          mMessageService.setImageUrl(imageUrl);
      };

      $scope.sendContent = function (editorialreview) {
          mMessageService.setMovieDescription(editorialreview);
      };

      $scope.sendActors = function (actor) {
          mMessageService.setActor(actor);
      };

      $scope.sendDirectors = function (director) {
          mMessageService.setDirector(director);
      };

  })
 .controller("vendorCtrl", function ($scope, $http, $window, mMessageService, flixMovieService) {
     $scope.loadVendors = function () {
         var url = "api/flix_academy_admin_api.php?action=getVendors&api_token=flixteam2014";
         $http.get(url).then(function (data) {
             //$scope.data = data;
             $scope.vendors = data.data.vendors;
         });
     };

     var promise = flixMovieService.getFlixVendors();
     promise.then(function (data) {
         $scope.vendors = data.data.vendors;
     });


     $scope.searchVendor = function (baseUrl) {
         $window.open(baseUrl + mMessageService.message.replace(" ", "%20"));
     };

     $scope.linkVendor = function (vendor, vendorProductLink) {
         $http.post("db/addVendorLink.php", {
             product_id: mMessageService.product_id,
             vendor_id: vendor.vendor_id,
             vendor_product_link: vendorProductLink,
             vendor_price: 0,
             vendor_isFree: 0,
             use_search: 0
         })
        .success(function (data, status, headers, config) {
            alert("movie linked to  " + vendor.vendor_name + " url = " + vendorProductLink);
            mMessageService.prepFlixMovieForBroadcast(mMessageService.product_id);
            $scope.loadVendors();
        }).error(function (data, status, headers, config) {
            alert("error!");
        });

     };


 })
 .controller("omdb_searchCtrl", function ($scope, $http, mMessageService) {

     $scope.getMovie = function (imdbID) {
         var url = "http://www.omdbapi.com/?&y=&plot=full&r=json&tomatoes=true&i=" + imdbID;
         $http.get(url).then(function (data) {
             return data;
         });
     };

     $scope.select = function (movie) {
         if (mMessageService.movie.product_id > 0) {
             mMessageService.prepOMDBMovieForBroadcast(movie, mMessageService.movie.product_id);
         } else {
             mMessageService.prepOMDBMovieForBroadcast(movie);
         }

     };

     $scope.getData = function () {
         var movies = [];
         var str = "";
         var url = "http://www.omdbapi.com/?&y=&plot=full&r=json&s=" + mMessageService.message.replace(" ", "%20");
         $http.get(url).then(function (data) {
             angular.forEach(data.data.Search, function (movie) {
                 var _url = "http://www.omdbapi.com/?&y=&plot=full&r=json&tomatoes=true&i=" + movie.imdbID;
                 $http.get(_url).then(function (_data) {
                     var obj = angular.fromJson(_data.data);
                     movies.push(obj);
                 });
             });
             $scope.omdbs = movies;
         });
     };

     $scope.getSearchData = function () {
         var movies = [];
         var str = "";
         var url = "http://www.omdbapi.com/?&y=&plot=full&r=json&s=" + $scope.search.replace(" ", "%20");
         $http.get(url).then(function (data) {
             angular.forEach(data.data.Search, function (movie) {
                 var _url = "http://www.omdbapi.com/?&y=&plot=full&r=json&tomatoes=true&i=" + movie.imdbID;
                 $http.get(_url).then(function (_data) {
                     var obj = angular.fromJson(_data.data);
                     movies.push(obj);
                 });
             });
             $scope.omdbs = movies;
         });
     };

     $scope.searchVendor = function () {
     };


 })
  .controller("homeCtrl", function ($scope, $http) {

      $scope.loadCounts = function () {
          var url = "api/flix_academy_admin_api.php?action=getAdminCounts&api_token=flixteam2014";
          $http.get(url).then(function (data) {

              var adminCounts = data.data.adminCounts;

              $scope.userCount = adminCounts.userCount;
              $scope.remixCount = adminCounts.remixCount;
              $scope.suggestionCount = adminCounts.suggestionCount;
              $scope.playlistCount = adminCounts.playlistCount;
              $scope.approvedMovieCount = adminCounts.approvedMovieCount;
              $scope.gradedMovieCount = adminCounts.gradedMovieCount;


          });
      };

      $scope.loadCounts();

  })
  .controller("dataMaintenanceCtrl", function ($scope, $http) {

      $scope.$on('$stateChangeSuccess', function () {
          $scope.loadSubjects();
      });

      // Topic Maintenance
      $scope.loadSubjects = function () {
          var url = "api/flix_academy_admin_api.php?action=getParentTopics&api_token=flixteam2014";
          $http.get(url).then(function (data) {
              $scope.flixSubjects = data.data.topics;
          });
      };

      $scope.btnSaveTopic = function () {

          var subject_name = $scope.toProperCase($scope.newTopic);
          var type = 1;
          var parent_id = $scope.selectedParentID;

          if (parent_id == 0) {
              type = 0;
          }

          var url = "api/flix_academy_admin_api.php?" +
                    "action=insertNewTopic" +
                    "&api_token=flixteam2014" +
                    "&subject_name=" + subject_name +
                    "&type=" + type +
                    "&parent_id=" + parent_id;

          $http.get(url).then(function (data) {
              var response = data.data.newSubjectEntry;
              var topic = data.data.subject_name;
              alert(topic + " added " + response);
              $scope.newTopic = "";
              $scope.loadSubjects();
          });
      };


      $scope.toProperCase = function (input) {
          var words = input.split(' ');
          var results = [];
          for (var i = 0; i < words.length; i++) {
              var letter = words[i].charAt(0).toUpperCase();
              results.push(letter + words[i].slice(1));
          }
          return results.join(' ');
      };

  }) 
  
    .controller("flixMovieCtrlOLD", function ($scope, $state, $http, $filter, $window, $q, movieService) {

        $scope.isSearching = false;

        $scope.searchMovies = function () {

            $scope.isSearching = true;

            if ($scope.selectedFilter == 1) {
                //search
                var searchFor = $scope.flixSearch;
                if (searchFor != null) {
                    if (searchFor.length > 0) {
                        $scope.getFlixCustomList('title LIKE \'%' + searchFor + '%\'');
                    }
                }
            } else {
                $scope.filterChanged();
            }

            $scope.isSearching = false;

        };

        $scope.loadMovie = function (movie) {
            movieService.set(movie);
            $state.go('movie_maintenance');
        };

        $scope.hasValue = function (item) {
            if (item.length > 0) {
                return item;
            } else {
                return null;
            }
        };

        $scope.filterChanged = function () {

            var value = $scope.selectedFilter;

            if (value == 2) {
                $scope.getFlixMoviesByUrl('getFlixMovies');
            } else if (value == 3) {
                $scope.getFlixMoviesByUrl('getMissingLinkMovies');
            } else if (value == 4) {
                $scope.getFlixMoviesByUrl('getMissingSubjectMovies');
            } else if (value == 5) {
                $scope.getFlixCustomList('product_image LIKE \'\'');
            } else if (value == 6) {
                $scope.getFlixCustomList('description LIKE \'\'');
            } else {

            }
        };

        $scope.subjectSelected = function () {

            var value = $scope.selectedSubjectID;

            if (value == 1) {
                $scope.getFlixMoviesByUrl('getFlixMovies');
            } else if (value == 2) {
                $scope.getFlixMoviesByUrl('getMissingLinkMovies');
            } else if (value == 3) {
                $scope.getFlixMoviesByUrl('getMissingSubjectMovies');
            } else if (value == 4) {
                $scope.getFlixCustomList('product_image LIKE \'\'');
            } else if (value == 5) {
                $scope.getFlixCustomList('description LIKE \'\'');
            } else {

            }
        };

        $scope.getFlixMoviesByUrl = function (action) {
            var url = "api/flix_academy_admin_api.php?action=" + action + "&api_token=flixteam2014";
            $http.get(url).then(function (data) {
                $scope.handleMovies(data.data.movies);
            }).error(function (data, status, headers, config) {
                $scope.isSearching = false;
            });
        };

        $scope.getFlixCustomList = function (where) {
            var url = "api/flix_academy_admin_api.php?action=getCustomList&api_token=flixteam2014&where=" + where;
            $http.get(url).then(function (data) {
                $scope.handleMovies(data.data.movies);
            }).error(function (data, status, headers, config) {
                $scope.isSearching = false;
            });
        };

        $scope.handleMovies = function (movies) {
            //$scope.clearVendors();
            $scope.vendorLink = [];
            $scope.vendorLink = $scope.get2DArray(movies.length, $scope.allVendors.length, '');
            $scope.isSearching = false;
            $scope.movies = null;
            $scope.movies = movies;

            $scope.scrollUp("#resultsHeader", 750);
        }

        $scope.scrollUp = function (location, height) {
            setTimeout(function () {
                $('html, body').animate(
                    { scrollTop: $(location).offset().top },
                    height,
                    function () {

                    });
            });
        }

        $scope.movieTitleClickOLD = function (movie, index) {
            $scope.showEdit[index] = !$scope.showEdit[index];
            if ($scope.showEdit[index]) {
                $scope.scrollUp("startingPoint", 750);
                $scope.loadTopics(index);
                $scope.loadVendors(index);
            }
        }

        $scope.movieTitleClick = function (movie, index) {
            $scope.showRight = 1;
            $scope.movieTitle = movie.title;
            $scope.movieProductImage = movie.product_image;
        }

        $scope.loadTopics = function (index) {
            $scope.flixSubjects[index] = $scope.allTopics;
        };

        $scope.loadVendors = function (index) {
            $scope.flixVendors[index] = $scope.allVendors;
        };

        $scope.loadAllTopics = function () {
            var url = "api/flix_academy_admin_api.php?action=getSubjects&api_token=flixteam2014";
            $http.get(url).then(function (data) {
                $scope.allTopics = data.data.subjects;
            });
        };

        // Topic Maintenance
        $scope.loadTopicsAndSubtopics = function () {
            var url = "api/flix_academy_admin_api.php?action=getTopicsAndSubtopics&api_token=flixteam2014";
            $http.get(url).then(function (data) {
                $scope.topicsAndSubtopics = data.data.topics;
            });
        };


        // Topic Maintenance
        $scope.initTopics = function () {
            $scope.topics = $scope.topicsAndSubtopics;
        };

        // Vendor Maintenance
        $scope.initVendors = function () {
            $scope.vendors = $scope.allVendors;
        };

        $scope.initVendorLinks = function (movie) {
            angular.forEach($scope.allVendors, function (vendor, v_index) {
                angular.forEach(movie.vendors, function (movieVendor, mv_index) {
                    if (movieVendor.vendor_id == vendor.vendor_id) {
                        $scope.vendorLink[v_index] = movieVendor.vendor_product_link;
                    }
                });
            });
        };

        $scope.loadAllVendors = function () {
            var url = "api/flix_academy_admin_api.php?action=getVendors&api_token=flixteam2014";
            $http.get(url).then(function (data) {
                $scope.allVendors = data.data.vendors;
            });
        };

        $scope.deleteVendor = function (movie, vendor, movieIndex, vendorIndex) {
            $http.post("db/removeVendorLink.php", {
                product_id: movie.product_id,
                vendor_id: vendor.vendor_id
            })
        .success(function (data, status, headers, config) {
            $scope.getFlixMovie(movie.product_id, movieIndex);
            $scope.vendorLink[movieIndex][vendorIndex] = '';
        }).error(function (data, status, headers, config) {
            alert("error!");
        });

        };

        $scope.getFlixMovie = function (product_id, index) {
            var url = "api/flix_academy_admin_api.php?action=getFlixMovie&api_token=flixteam2014&product_id=" + product_id;
            $http.get(url).then(function (data) {
                var movie = data.data.movies[0];
                $scope.movies[index] = movie;
                $scope.handleMovies($scope.movies);
            });
        };

        $scope.btnDeleteMovie = function (movie) {

            if (confirm("are you sure you want to delete " + movie.title + " from Flix Academy") == true) {
                $http.post("db/deleteMovie.php", { product_id: movie.product_id })
        .success(function (data, status, headers, config) {
            alert(movie.title + " deleted from Flix Academy"); //data.data(0).movieStatus(0).status                           
        }).error(function (data, status, headers, config) {
            alert("error!");
        });
            } else {
                alert($scope.movieTitle + " will remain on Flix Academy");
            }
        };

        $scope.btnSaveUpdate = function (index) {

            if ($scope.isNumeric($scope.filteredMovies[index].product_id)) {
                $scope.updateFlix(index);
            }
        };

        $scope.updateFlix = function (index) {


            var slength = $scope.filteredMovies[index].length;
            var iLength = 0;
            var length = "";

            if ($scope.isNumeric(slength)) {
                iLength = slength;
            } else {
                length = slength.replace(/[^0-9]/g, '');
                if ($scope.isNumeric(length)) {
                    iLength = length;
                }
            }

            /*
            alert("product_id: " + $scope.getValue($scope.filteredMovies[index].product_id));
            alert("title: " + $scope.getValue($scope.filteredMovies[index].title));
            alert("rating: " + $scope.getValue($scope.filteredMovies[index].rating));
            alert("release_date: " + $scope.getValue($scope.filteredMovies[index].release_date)); //$scope.movieReleased, get date format
            alert("release_year: " + $scope.getValue($scope.filteredMovies[index].release_year));
            alert("length: " + iLength);
            alert("description: " + $scope.getValue($scope.filteredMovies[index].description));
            alert("status_id: " + '1');
            alert("age_min: " + '0');
            alert("age_max: " + '0'); // get age
            alert("product_image: " + $scope.getValue($scope.filteredMovies[index].product_image));
            alert("country: " + $scope.getValue($scope.filteredMovies[index].country));
            alert("language: " + $scope.getValue($scope.filteredMovies[index].language));
            alert("actors: " + $scope.getValue($scope.filteredMovies[index].actors));
            alert("director: " + $scope.getValue($scope.filteredMovies[index].director));
            alert("writer: " + $scope.getValue($scope.filteredMovies[index].writer));
            alert("awards: " + $scope.getValue($scope.filteredMovies[index].awards));
            alert("type: " + $scope.getValue($scope.filteredMovies[index].type)); 
            alert("imdb_id:" +  $scope.getValue($scope.filteredMovies[index].imdb_id));
            */
            $http.post("db/updateMovie.php", {
                product_id: $scope.getValue($scope.movies[index].product_id),
                title: $scope.getValue($scope.movies[index].title),
                rating: $scope.getValue($scope.movies[index].rating),
                release_date: $scope.getValue($scope.movies[index].release_date), //$scope.movieReleased, get date format
                release_year: $scope.getValue($scope.movies[index].release_year),
                length: iLength,
                description: $scope.getValue($scope.movies[index].description),
                status_id: 1,
                age_min: 0,
                age_max: 0, // get age
                product_image: $scope.getValue($scope.movies[index].product_image),
                country: $scope.getValue($scope.movies[index].country),
                language: $scope.getValue($scope.movies[index].language),
                actors: $scope.getValue($scope.movies[index].actors),
                director: $scope.getValue($scope.movies[index].director),
                writer: $scope.getValue($scope.movies[index].writer),
                awards: $scope.getValue($scope.movies[index].awards),
                type: 1, //$scope.getValue($scope.filteredMovies[index].type),
                imdb_id: $scope.getValue($scope.movies[index].imdb_id)
            })
        .success(function (data, status, headers, config) {
            // alert($scope.getValue($scope.filteredMovies[index].title) + " updated on Flix Academy"); //data.data(0).movieStatus(0).status 
            alert("We're Back!");
            alert(data.response); //.movieStatus[0].updateStatus);
            //$state.reload();
            //$scope.getFlixMovie(productId);

        }).error(function (data, status, headers, config) {
            alert("failure message: " + JSON.stringify({ data: data }));
        });

        };

        $scope.getValue = function (value) {

            var val = "";

            if (!angular.isUndefined(value)) {
                val = value;
            }

            return val;

        }

        $scope.isNumeric = function (num) {
            return !isNaN(num);
        };

        $scope.makeIMDBUrl = function (imdbID) {
            return "http://www.imdb.com/title/" + imdbID;
        };


        $scope.saveVendor = function (movie, vendor, link) {

            if (link.length > 0) {
                $http.post("db/addVendorLink.php", {
                    product_id: movie.product_id,
                    vendor_id: vendor.vendor_id,
                    vendor_product_link: link,
                    vendor_price: 0,
                    vendor_isFree: 0,
                    use_search: 0
                })
                    .success(function (data, status, headers, config) {
                        //alert(vendor.vendor_name + " - " + link + " added to " +
                        //movie.title);
                    }).error(function (data, status, headers, config) {
                        alert("error!");
                    });
            }

        };

        $scope.saveVendors = function (movie) {

            var arr = [];
            var updatedCount = 0;
            var movieIndex = $scope.getMovieIndex(movie);
            var isAdding = true;

            //should fill the arr Array with the # of vendors in our vendor table
            //use movie index and vendor index to id the address of the 
            //specific input box
            angular.forEach($scope.allVendors, function (link, vendorIndex) {
                arr[vendorIndex] = $scope.vendorLink[movieIndex][vendorIndex];
            });

            $q.all([

                angular.forEach(arr, function (link, index) {

                    var vendor = $scope.allVendors[index];
                    if (link.length > 0) {
                        updatedCount = updatedCount + 1;
                        $scope.saveVendor(movie, vendor, link);
                    }

                })

            ]).then(function (data) {
                //$scope.movies = null;
                alert("Added " + updatedCount + " links to " + movie.title + "!");
                $scope.getFlixMovie(movie.product_id, movieIndex);
            });

        }

        $scope.getMovieIndex = function (movie) {

            var index = -1;
            i = $scope.movieKeyList.length;

            while (i--) {
                if ($scope.movieKeyList[i].product_id == movie.product_id) {
                    index = $scope.movieKeyList[i].index;
                }
            }


            return index;
        }

        $scope.storeMovie = function (movie) {
            $scope.movieList.push(movie);
            $scope.movieIndex = $scope.movieList.length - 1;

            var movieKey = { "product_id": movie.product_id, "index": $scope.movieIndex };
            $scope.movieKeyList.push(movieKey);
        }

        $scope.setVendorLinkValue = function (vendor, movie, movieIndex, vendorIndex) {
            angular.forEach(movie.vendors, function (movieVendor, mv_index) {
                if (movieVendor.vendor_id == vendor.vendor_id) {
                    $scope.vendorLink[movieIndex][vendorIndex] = movieVendor.vendor_product_link;
                }
            });
        }

        $scope.get2DArray = function (rows, cols, defaultValue) {

            var arr = [];

            // Creates all lines:
            for (var i = 0; i < rows; i++) {

                // Creates an empty line
                arr.push([]);

                // Adds cols to the empty line:
                arr[i].push(new Array(cols));

                for (var j = 0; j < cols; j++) {
                    // Initializes:
                    arr[i][j] = defaultValue;
                }
            }

            return arr;
        }

        $scope.clearVendors = function () {

            var i = $scope.movieIndex;
            while (i > -1) {
                angular.forEach($scope.allVendors, function (vendor, vendorIndex) {
                    $scope.vendorLink[i][vendorIndex] = '';
                })
                i--;
            }

        }

        $scope.updateTopic = function (topic, value) {

            var movie = movieService.get();

            if (value) {

                $http.post("db/addSubject.php", {
                    product_id: movie.product_id,
                    subject_id: topic.subject_id
                })
                    .success(function (data, status, headers, config) {
                        $scope.getFlixMovie(movie.product_id, movieIndex);
                    }).error(function (data, status, headers, config) {
                        alert("error!");
                    });

            } else {


                $http.post("db/removeSubject.php", {
                    product_id: movie.product_id,
                    subject_id: topic.subject_id
                })
                .success(function (data, status, headers, config) {
                    $scope.getFlixMovie(movie.product_id, movieIndex);
                }).error(function (data, status, headers, config) {
                    alert("error!");
                });

            }

        }

        $scope.getTopicValue = function (movieIndex, topic) {

            alert("length = " + $scope.movies[movieIndex].subjects.length);

            angular.forEach($scope.movies[movieIndex].subjects, function (subject, index) {
                if (subject.subject_id == topic.subject_id) {
                    return true;
                } else {
                    return false;
                }
            })

        }

        $scope.movieIndex = -1;
        $scope.topicsAndSubtopics = {};
        $scope.allTopics = {};
        $scope.allVendors = {};
        $scope.showEdit = [];
        $scope.flixSubjects = [];
        $scope.flixVendors = [];
        $scope.product_image = [];
        $scope.release_year = [];
        $scope.rating = [];
        $scope.length = [];
        $scope.release_date = [];
        $scope.genre = [];
        $scope.director = [];
        $scope.writer = [];
        $scope.actors = [];
        $scope.language = [];
        $scope.country = [];
        $scope.description = [];
        $scope.awards = [];
        $scope.imdb_id = [];
        $scope.type = [];
        $scope.product_id = [];
        $scope.vendorLinkUrl = [];
        $scope.movieList = [];
        $scope.vendorLink = []; //$scope.get2DArray(200, 10, '');
        $scope.movieTopic = [];
        $scope.movieKeyList = [];
        $scope.showRight = 0;

        $scope.loadAllTopics();
        $scope.loadAllVendors();
        $scope.loadTopicsAndSubtopics();

    })



/*

  OLD
  app.config(['$urlRouterProvider', '$stateProvider', function ($urlRouterProvider, $stateProvider) {
      $urlRouterProvider.otherwise('/');
      $stateProvider.state('index', {
          url: "",
          views: {
              "viewA": {
                  templateUrl: "tab_menu.html"
              },
              "viewB": {
                  templateUrl: "movie_maintenance.html" //flix_remix_submission.html
              }
          }
      })
  } ])

  */