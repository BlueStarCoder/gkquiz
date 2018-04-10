(function(){

    var app = angular.module('myQuiz', []);

    app.controller('QuizController', ['$scope', '$http', '$sce', function($scope, $http, $sce){
        $scope.score = 0;
        $scope.activeQuestion = -1;
        $scope.activeQuestionAnswered = 0;
        $scope.percentage = 0;
        $scope.records = { 'stname' : 'Name', 'stclass': 'V', 'stsec': 'A', 'stroll': 'Select Roll No.' };

        $scope.initialize = function() {
            function replaceCharMutable(stringvalue, fromChar = '', toChar = '', timesToReplace = 1) {
                for (var i = 0; i <= timesToReplace; i++) {
                    stringvalue = stringvalue.replace(fromChar, toChar);
                }
                return stringvalue;
            }
            var getstring = window.location.search;
            getstring = replaceCharMutable(getstring, '?', '');
            getstring = replaceCharMutable(getstring, '+', ' ', 6);
            getstring = replaceCharMutable(getstring, '=', '&', 15);
            var stdarray = getstring.split('&');
            $scope.records.stclass = stdarray[1];
            $scope.records.stsec = stdarray[3];
            $scope.records.stroll = stdarray[5];
            $scope.records.stname = stdarray[7];
            $scope.update();
            $scope.activeQuestion = 0;
        };

        $scope.update = function(actionCall = '') {
            url = 'jsondatafunc.php?action=jsondata&stclass=' + $scope.records.stclass + "&stsec=" + $scope.records.stsec + "&stroll=" + $scope.records.stroll;
            $http.get(url).then(function(stData) {
                    $scope.myQuestions = stData.data;
                    $scope.totalQuestions = $scope.myQuestions.length;
            });
        };
        
        $scope.selectAnswer = function(qIndex, aIndex){

            var questionState = $scope.myQuestions[qIndex].questionState;

            if (questionState !== 'answered' ) {
                $scope.myQuestions[qIndex].selectedAnswer = aIndex;
                var correctAnswer = $scope.myQuestions[qIndex].correct;
                $scope.myQuestions[qIndex].correctAnswer = correctAnswer;

                if (aIndex === correctAnswer ) {
                    $scope.myQuestions[qIndex].correctness = 'correct';
                    $scope.score += 1;
                } else {
                    $scope.myQuestions[qIndex].correctness = 'incorrect';
                }
                $scope.myQuestions[qIndex].questionState = 'answered';
            }
            $scope.percentage = (($scope.score / $scope.totalQuestions)*100).toFixed(1);
        };

        $scope.isSelected = function(qIndex, aIndex) {
            return $scope.myQuestions[qIndex].selectedAnswer === aIndex;
        };
        
        $scope.isCorrect = function(qIndex, aIndex) {
            return $scope.myQuestions[qIndex].correctAnswer === aIndex;
        };
        
        $scope.selectContinue = function() {
            return $scope.activeQuestion += 1;
        };
        
        $scope.submitResult = function() {
            url = 'jsondatafunc.php?action=submitresult&stclass=' + $scope.records.stclass + "&stsec=" + $scope.records.stsec + "&stroll=" + $scope.records.stroll + "&score=" + $scope.score;
            $http.get(url).then(function(res) {
                if (res.data) {
                    alert('Your Test is Complete.');
                    window.open('/', '_self');
                }
            });
        };
    }]);
})();
