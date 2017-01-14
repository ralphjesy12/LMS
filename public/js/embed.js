window.onload = function(){
    var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
    var eventer = window[eventMethod];
    var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

    if(parent.postMessage)
    {
        var height = document.body.scrollHeight;
        parent.postMessage(height, '*');
    }
}
