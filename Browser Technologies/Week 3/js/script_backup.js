var fn = fn || {};
'use strict';


var results = document.getElementById('results');
var cluboption = document.getElementById('cluboption');
var leicester = document.getElementById('leicester');
var leicesterTwo = document.getElementById('leicestertwo');
var docBody = document.querySelector('body');
var notifTitle = document.getElementById('notification-title');
var notifContent = document.getElementById('notification-content');


document.addEventListener('DOMContentLoaded', function () {
    results.classList.add('inactive');
    cluboption.classList.remove('inactive');

    if (isNewNotificationSupported()) {
        docBody.classList.add('nf-supported');
    }
    fn.launcher.init();

});

fn.launcher = (function () {
    var clubButton = document.querySelectorAll('.clubButton');
    var init = function () {

        fn.loop.loopFunc();
    }

    return {
        init: init
    }
})();


fn.loop = (function () {
    var clubButton = document.querySelectorAll('.clubButton');
    var cluboption = document.getElementById('cluboption');

    function loopFunc() {

        var pushNotification = document.getElementById('push-notification');
        cluboption.addEventListener('click', function (e) {
            var result = e.target.attributes['data-result'].value;
            var matchup = e.target.attributes['data-match'].value;
            if (docBody.className !== 'nf-supported') {
                pushNotification.classList.remove('inactive');
                fn.notification.showSection(result, matchup);
            } else {
                fn.notification.webNotification(result, matchup);
                console.log('Melvin');
            }
        })

    }

    return {
        loopFunc: loopFunc
    }
})();

fn.notification = (function () {
    function showSection(result, matchup) {
        notifTitle.innerHTML = matchup;
        notifContent.innerHTML = "Score: " + result;

    };

    function webNotification(result, matchup) {
        if (window.Notification && Notification.permission == 'granted') {
            console.log(notifContent);
            var notification = new Notification(matchup, {
                icon: 'http://i.ebayimg.com/00/s/ODg2WDg4Ng==/z/X-8AAOxyNmZTj3tF/$_35.JPG',
                body: result
            });
        } else if (isNewNotificationSupported()) {
            Notification.requestPermission();
        }
    }

    return {
        showSection: showSection,
        webNotification: webNotification
    }

})();

function checkButton() {
    var pushNotification = document.getElementById('push-notification');
    var closeButton = document.getElementById('confirm');
    closeButton.addEventListener('click', function () {
        pushNotification.classList.add('inactive');
    })
}

checkButton();

//Thanks to Joost Faber for helping me rewrite this for progressive enhancement.
//Source: https://developers.google.com/web/updates/2015/05/notifying-you-of-changes-to-notifications
function isNewNotificationSupported() {
    var docBody = document.querySelector('body');
    if (!window.Notification || !Notification.requestPermission) {
        return false;
    }

    if (Notification.permission == 'granted') {
        docBody.classList.add('nf-supported');
        return true;
    }
    try {
        new Notification('...');
    } catch (e) {
        if (e.name == 'TypeError')
            fn.loop.loopFunc();
        return false;
    }

    return true;
}