<?php
$settings = parse_ini_file(__DIR__.'/config.ini', true);
?>
<html>
<head>
    <title>oAuth social Login</title>
    <style>
        .BtnGroup{
            width: 100%;
        }
        .BtnGroup button{
            height: 60px;
            width: 120px;
        }
        #OutputConsole{
            width: 100%;
            min-height: 300px;
            background-color: lightgrey;
        }
    </style>
</head>
<div class="BtnGroup">
    <button type="button" onclick="google.authorize();">Login with Google</button>
    <button type="button" onclick="facebook.authorize();">Login with Facebook</button>
    <br />

    <button type="button" onclick="google.getProfile();">Get Google-Profile</button>
    <button type="button" onclick="facebook.getProfile();">Get Facebook-Profile</button>
</div>
<div id="OutputConsole">

</div>

<script src="script/demo.js"></script>
<script src="script/google.js"></script>
<script src="script/facebook.js"></script>
<script>
    // set the config.ini vars to javascript
    var social_login_options = {
        google: {
            client_id: '<?php echo $settings['google']['client_id']; ?>',
            redirect_uri: '<?php echo $settings['google']['redirect_uri']; ?>',
            login_uri: '<?php echo $settings['google']['login_uri']; ?>',
            scope: '<?php echo $settings['google']['scope']; ?>',

            token_uri: '<?php echo $settings['google']['token_uri']; ?>'
        },
        facebook: {
            client_id: '<?php echo $settings['facebook']['client_id']; ?>',
            redirect_uri: '<?php echo $settings['facebook']['redirect_uri']; ?>',
            login_uri: '<?php echo $settings['facebook']['login_uri']; ?>',
            scope: '<?php echo $settings['facebook']['scope']; ?>',

            token_uri: '<?php echo $settings['facebook']['token_uri']; ?>'
        },
        origin: '<?php echo $settings['origin']; ?>'
    };
</script>
</html>