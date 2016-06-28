/**
 * Created by roman on 28.06.16.
 */

/**
 *  The function will be called on a Postmessage-Event (check allowed Origins for security)
 * @param _popup    -> The return Value of window.open()
 * @param _fn       -> function to be executed
 */
var setEventListener = function (_fn) {
    var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
    var eventer = window[eventMethod];
    var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

    // Listen to message from child window
    eventer(messageEvent, function (e) {
        if (social_login_options.origin == e.origin) {
            _fn(JSON.parse(e.data));
        }
    }, false);
}

var afterLoginFunction = function(data){
    document.getElementById('OutputConsole').innerHTML = 'Loggin was successed for more information look into dev-console.';
    console.log(data);
};

var profileReceivedFn = function(profile){
    document.getElementById('OutputConsole').innerHTML = JSON.stringify(profile, null, 4);
    console.log(profile);
};
