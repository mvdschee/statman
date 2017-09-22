//----------------------------FACEBOOK SPUL HIERONDER------------------------------//
$("#js-loggedin-info").hide();
$("#js-login-fb").hide();
/* fbAsyncInit
 *
 * Set variables to connect the page with our facebook-app
 *
 */
window.fbAsyncInit = function() {
    FB.init({
        appId      : '188876558188407',
        xfbml      : true,
        version    : 'v2.8'
    });

    if (!loginCheck()) {
        $("#js-login-fb").show();
    }
    getData();
};

/* Connect the page with facbook sdk libary
 *
 * @id (int) id of our facebook-app
 * @d & s (?) i have no clue
 */
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


/* myFacebookLogin
 *
 * login with your facebook account
 *
 */
function login_fb() {
    console.log('Login: User wants to log in');
    loginCheck();
    FB.login(function(response){
         if (response.authResponse) {
            console.log("Login: User is logged in");
            $("#js-login-fb").hide();
            loginCheck();
            document.location.reload();
         }
         else{
            console.log('Login: User cancelled login or did not fully authorize.');
         }
    }, {
        scope: 'manage_pages',
        return_scopes: true
    });
}

function loginCheck(){
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        console.log('Check: Logged in.');
        return true;
      }
      else {
        console.log('Check: Not logged in.');
        return false;
      }
    });
}

/* logout
 *
 * logout from facebook on this site
 *
 */
function logout_fb() {
    console.log('Logout: function logout is called');
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.logout(function(response) {
                console.log('Logout: user is logged out');
                document.location.reload();
            });
        }
        else{
            console.log('Logout: user wasn\'t logged in');
        }
    });
}

/* dashboard
 *
 * Checks if the user is logged in
 *
 * Fills the dashboard if user is logged in
 */
function getData(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            getUser();
            getPages();
            $("#js-login-fb").hide();
            $("#js-loggedin-info").show();
        }
    });
}

/* getUser
 *
 * Gets user data from the facebook api and show them in a table in the dashboard
 */
function getUser(){
    FB.api('/me', {fields: 'picture.type(large),id,name,email,link'}, function(response) {
        console.log("Getting user...");
    });
}

/* getPages
 *
 * Gets user pages from the facebook api and show them in the dashboard
 * returns the first access token of a page from the owner
 */
function getPages(){
    FB.api('/me/accounts', {fields: ''}, function(response) {
        console.log("Get pages...");

        var page_list = document.getElementById("pagelist");
        var data = response.data;
        var count;

        data.forEach(function(entry){
            if (count == 0) {
                count++;
                access_token = entry.access_token;
                console.log(access_token);
            }
            page_list.innerHTML += "<tr class='page'><td><a href='#' onClick='selectPage(\"" + entry.access_token + "\", \"" + entry.name + "\");'>" + entry.name + "</td></tr>";
        });
    });
}


function selectPage(token, name){
	var token_input = document.getElementById('token_input');
	var name_input = document.getElementById('name_input');
	var index_input = document.getElementById('index_input');

	name_input.value = name;
	index_input.value = '0';

    client_id = '188876558188407';
    client_secret = '0a239d9768b14c9a5868fbc5c726de80';
    token_link = 'https://graph.facebook.com/oauth/access_token?client_id=' + client_id + '&client_secret=' + client_secret + '&grant_type=fb_exchange_token&fb_exchange_token=' + token;
    
    $.getJSON(token_link, function(data) {
        token_input.value = data.access_token;
        $('#js-page-form').submit();
    });
}

