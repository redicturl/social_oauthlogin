# oAuth Login for Sozial Platforms

To implement an oAuth login, you have to register you application on the service:

facebook: https://developers.facebook.com/quickstarts/?platform=web

google: https://console.developers.google.com/apis/library?


## install 
copy this folder to webfolder - the index file must be accessible on 
- http://localhost/social_oauthlogin
more important are the receive-files which have to be accessible on
- http://localhost/social_oauthlogin/authcode_receiver/google.php
and 
- http://localhost/social_oauthlogin/authcode_receiver/facebook.php
This uri is set on the google and facebook console and will be validated

For own facebook and google accounts: 
- create project on the platform
- set the client ID and the client secret in the config.ini files
