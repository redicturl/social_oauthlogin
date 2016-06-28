<?php
$settings = parse_ini_file(__DIR__.'/../config.ini', true);
$err = '';
$token = null;
?>
<?php
// Serverrequest to exchange the received code with an access_token and refresh token
if (isset($_REQUEST['code'])) {
    $code = $_REQUEST['code'];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $settings['google']['authorize_uri']);
    $data = array(
        'code'          => $code,
        'client_id'     => $settings['google']['client_id'],
        'client_secret' => $settings['google']['client_secret'],
        'redirect_uri'  => $settings['google']['redirect_uri'],
        'grant_type'    => 'authorization_code'
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close($ch);
    if (!$server_output == false) {

        $response=json_decode($server_output);
        // check if received value has the property
        if(property_exists($response, 'access_token')){
            // here you can set the tokens to a session and set the User as authentificated
             $token = $response;
        }else{
            $err = 'No valid token received.';
        }
    }else{
        $err = 'Response is empty';
    }
}else{
    $err = 'Haven\'t received a code from Google';
}
?>
<html>
<body>
<?php
    if($token != null){
        ?>
        <h2>Logging in was successed</h2>
        <script>
            if(window.opener !== null){
                // In PHP: set the token to a json - in javascript stringify to send with postmessage
                window.opener.postMessage(
                    JSON.stringify('<?php echo json_encode($token); ?>'),
                    '<?php echo $settings['origin']; ?>');
                window.close();
            }
        </script>
    <?php
    }else{
        ?>
        <h2>Login failed</h2>
        <p><?php echo $err; ?></p>
    <?php
    }
?>
</body>
</html>