'use strict';

app.controller('HomepageCtrl', function ($scope, $http, $sce) {

    $scope.sectionData = 'test';

    $scope.leftcontent = '';
    $scope.projects = [];
    $scope.post = [];
    var _html1 = $('.hidden-section-1').html();
    var _html2 = $('.hidden-section-2').html();
    var _html3 = $('.hidden-section-3').html();
    var _html4 = $('.hidden-section-4').html();
    var _html5 = $('.hidden-section-5').html();
    $('#homevideo').modal('show');
    $scope.$watch('projects', function () {

        $scope.mainOptions = {
            navigation: true,
            navigationPosition: 'right',
            scrollingSpeed: 1000,
             //easingcss3: 'cubic-bezier(1.000, 0.000, 0.000, 1.005) 0.5s',
            afterLoad: function (anchorLink, index) {
                if (index == 1) {
                    $('.js-left-content').html(_html1);
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-1');
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-4');
                }

                if (index == 2) {
                    $('.js-left-content').html(_html2);
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-1');
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-4');
                }
                if (index == 3) {
                    $('.js-left-content').html(_html3);
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-1');
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-4');
                }

                if (index == 4) {
                    $('.js-left-content').html(_html4);
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-4');
                }

                if (index == 5) {
                    $('.js-left-content').html(_html5);
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-1');
                }

                $('.js-left-content').removeClass('hide animated fadeOutUp').addClass('animated fadeInUp');
            },
            onLeave: function (page, next) {

                $('.js-left-content').removeClass('animated fadeInUp').addClass('animated fadeOutUp');
                $('.wrapper__home-left .content-wrapper').removeClass('post_0_background').removeClass('leftcontentbackgroundImage_1').removeClass('leftcontentbackgroundImage_2');

                if (next == 1) {
                    $('.leftcontent_topheading').show();
                }
                if (next == 2) {
                    $('.wrapper__home-left .content-wrapper').addClass('leftcontentbackgroundImage_1');
                }
                if (next == 3) {
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-1');
                    $('.wrapper__home-left .content-wrapper').addClass('leftcontentbackgroundImage_2');
                }
                if (next == 4) {
                    $('.wrapper__home-left .insight-bg').addClass('insight-bg-1');
                    $('.leftcontent_heading,.leftcontent_desc').addClass('text-white');
                    $('.wrapper__home-left .content-wrapper').addClass('post_0_background');
                }
                if (next == 5) {
                    $('.wrapper__home-left .insight-bg').removeClass('insight-bg-1');
                    $('.wrapper__home-left .insight-bg').addClass('insight-bg-4');
                }
            }
        };
    });


    $("#core-service-1").hover(
        function() {
            console.log('hit');
            $(this).attr("src", "/img/2016.0715_Cubeevo_Visual_Branding.gif");
        },
        function() {
            $(this).attr("src", "/img/Programmer Needs-36.svg");
        }
    );

    $("#core-service-2").hover(
        function() {
            console.log('hit');
            $(this).attr("src", "/img/2016.0715_Cubeevo_Thematic_Campaign_Design.gif");
        },
        function() {
            $(this).attr("src", "/img/Programmer Needs-37.svg");
        }
    );

    $("#core-service-3").hover(
        function() {
            console.log('hit');
            $(this).attr("src", "/img/2016.0715_Cubeevo_Online_Digital_Platform.gif");
        },
        function() {
            $(this).attr("src", "/img/Programmer Needs-38.svg");
        }
    );

    $("#core-service-4").hover(
        function() {
            console.log('hit');
            $(this).attr("src", "/img/2016.0715_Cubeevo_Explainer_Video_Production.gif");
        },
        function() {
            $(this).attr("src", "/img/Programmer Needs-39.svg");
        }
    );

});

app.filter('html', function ($sce) {
    return function (val) {
        return $sce.trustAsHtml(val);
    };
});