var googleUser = {};

var startApp = function () {
    gapi.load('auth2', function () {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '58247551043-juf2ucn2drbq9htineekosbm5bl8gd6t.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            scope: 'profile',
        });

        var element = document.getElementById('googleBtn');
        if (element != null && element != '') {
            attachSignin(element);
        }
    });
};

function signOut() {
    document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://www.faututoring.com/";
//    var auth2 = gapi.auth2.getAuthInstance();
//    auth2.disconnect().then(function () {
//        console.log('User revoked.');
//    });
//    auth2.signOut().then(function () {
//        console.log('User signed out.');
//    });
}

function attachSignin(element) {
    auth2.attachClickHandler(element, {}, function (googleUser) {
        var profile = googleUser.getBasicProfile();

        var googleID = profile.getId();
        var googleName = profile.getName();
        var googlePicture = profile.getImageUrl();
        var googleEmail = profile.getEmail();
        var googleToken = googleUser.getAuthResponse().id_token;

        var request = {
            'googleID': googleID,
            'googleName': googleName,
            'googlePicture': googlePicture,
            'googleEmail': googleEmail,
            'googleToken': googleToken
        };

        console.log(request);

        jQuery.ajax({
            url: '/user/site/googleLogin',
            data: request,
            type: 'POST',
            dataType: 'JSON',
            async: false,
            success: function (response) {
                if (response == '1') {
                    window.location.href = '/profile';
                } else {
                    alert('Google Login Failed! Please try again later!');
                }
            }
        });

    }, function (error) {
        console.log(JSON.stringify(error, undefined, 2));
    });
}

jQuery(function () {
    startApp();
});