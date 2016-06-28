/**
 * Created by roman on 28.06.16.
 */

var google = function(){

    var access_token = '';
    var id_token = '';

    var onLogin = function(data){
        access_token = data['access_token'];
        id_token = data['id_token'];
    };
    var myG = {
        authorize: function() {
            var params = '' +
                'client_id=' + social_login_options.google.client_id +
                '&redirect_uri=' + social_login_options.google.redirect_uri +
                '&response_type=code' +
                '&scope=' + social_login_options.google.scope;

            var authUrl = social_login_options.google.login_uri + params;

            window.open(authUrl, '_blank', 'location=no,toolbar=yes');
            setEventListener(function(response){
                var obj_data = JSON.parse(response);
                onLogin(obj_data);
                afterLoginFunction(obj_data);
            });
        },
        getProfile: function(){
            if(access_token.length > 0){
                var xhr = new XMLHttpRequest();
                var uri = social_login_options.google.token_uri + id_token;
                xhr.onreadystatechange = function(){
                    if(xhr.status == 200){
                        profileReceivedFn(xhr.response);
                    }
                };
                xhr.open('GET', uri, true);
                xhr.send();
            }else{
                alert('You have to sign in first');
            }

        }
    };
    return myG;
}();