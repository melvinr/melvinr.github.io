var matchup = document.getElementById('matchup'),
    score = document.getElementById('score'),
    nextUrl = score.getAttribute('data-to-page'),
    newNotification = false;

if (isNewNotificationSupported()) {
    if (Notification.permission === 'granted') {
        newNotification = true;

    } else if (Notification.permission == 'denied') {
        newNotification = false;
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function() {
            if (Notification.permission === 'granted') {
                newNotification = true;
                console.log('I have asked, got accepted');
            } else if (Notification.permission === 'denied') {
                newNotification = false;
                console.log('no support for notifications');
            }
        });
    }
}


function isNewNotificationSupported() {
    if (!window.Notification || !Notification.requestPermission) {
        return false;
    }
    if (Notification.permission == 'granted') {
        return true;
    }
    try {
        new Notification('...');
    } catch (e) {
        if (e.name == 'TypeError')
            alert('something has gone wrong')
        return false;
    }

    return true;
}


function nextPage() {
  $.ajax({
    url: nextUrl,
    type: "GET",
    success: function(data) {
      scoreNow = $(data).find('#score');
      newScore(scoreNow);
    }
  });
}

setTimeout(function() {
    nextPage();
}, 3000);


function newScore(scoreNow) {
    nextUrl = scoreNow[0].getAttribute('data-to-page');

    if (nextUrl !== null) {
        setTimeout(function() {
            nextPage();
        }, 3000);
    }
    score.innerHTML = scoreNow[0].textContent;
    scoreNotification(scoreNow[0]);
}

function scoreNotification(scoreNow) {
    var todayMatchup = matchup.getAttribute('data-match');
    var scoreValue = scoreNow.innerHTML;

    if (newNotification == true) {
        new Notification(todayMatchup, {
            icon: 'images/leicester.png',
            body: scoreValue
        });
    } else {
        console.log('no support for notifications');
    }
};
