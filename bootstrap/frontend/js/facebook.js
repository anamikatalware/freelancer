//Load the Facebook JS SDK
(function (d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));


// Init the SDK upon load
window.fbAsyncInit = function () {
    FB.init({
        appId: '1339635979396114', // App ID
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse XFBML
    });


// Specify the extended permissions needed to view user data
// The user will be asked to grant these permissions to the app (so only pick those that are needed)
    var permissions = [
        'email',
        'user_about_me'
    ].join(',');

// Specify the user fields to query the OpenGraph for.
// Some values are dependent on the user granting certain permissions
    var fields = [
        'id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'link',
        'email',
        'picture'
    ].join(',');

    function showDetails() {
        FB.api('/me', {fields: fields}, function (details) {
            // output the response
            //jQuery('#userdata').html(JSON.stringify(details, null, '\t'));
            //console.log(details);

            jQuery.ajax({
                url: '/user/site/fBLogin',
                data: details,
                dataType: 'JSON',
                type: 'POST',
                async: false,
                success: function (res) {
                    if (res == '1') {
                        window.location.href = '/profile';
                    } else {
                        alert('Facebook Login Failed! Please try again later!');
                    }
                }
            });

        });
    }


    function callOauthLogin() {
        //initiate OAuth Login
        FB.login(function (response) {
            // if login was successful, execute the following code
            if (response.authResponse) {
                showDetails();
            }
        }, {scope: permissions});
    }

    jQuery('.fb-signup').click(function () {
        callOauthLogin();
    });

    jQuery('.fb-signin').click(function () {
        callOauthLogin();
    });

};