


/*jslint browser: true, devel: true */
/*global jQuery, window */



/**
 * keepalive.js:  Contains a JavaScript "singleton" object that
 * controls a setInterval() that sends an ajax request to the
 * server in order to keep the user's current session from 
 * timing out. 
 * 
 * Public methods:
 * 
 *   init()             This method initializes keepalive by
 *                      starting the setInterval() to
 *                      periodically send the request to the
 *                      server
 * 
 *   contactServer()    This method sends the ajax reqeust to
 *                      the server.
 * 
 * 
 * 
 * Implementation details: See comments in the code
 *  
 */


var KeepAlive = {};

KeepAlive = 
{
    statusSend        : 0,
	statusRcvd        : 0,
    keepAliveInterval : null,
	requestTime       : 0,
	totalTime         : 0,
	averageTime       : 0,
	init : function()
    {
        // set up the Interval to contact the server every 5 minutes
        // specify in milliseconds 5 * 60 * 1000
        this.keepAliveInterval = setInterval(KeepAlive.contactServer, 300000);
        //keepAliveInterval = setInterval(KeepAlive.contactServer, 1000);
    },
	contactServer : function()
    {
		//increment the send counter
		KeepAlive.statusSend += 1;

        // grab the time that the server request was made
        KeepAlive.requestTime = new Date().getTime();

        // send off the request to the server
        jQuery.ajax(
        {
            url      : "inc/sameside-keep-alive.php",
            type     : "POST",
            data     :  {keepalive: "contact"},
            datatype : "text",
            timeout  : 20000,
            error    : function()
            {
                // DO NOT update the rcvd counter
                // update the keep alive status display
				jQuery("#keepAliveStatus").text("Keep-alive: sent: " + KeepAlive.statusSend + ", rcvd: " + KeepAlive.statusRcvd + ", average time: " + KeepAlive.averageTime + " ms");
            },
            success  : function(response, status)
            {
                // increment the rcvd counter
				KeepAlive.statusRcvd += 1;

                //calculate the average round-trip interval so far
				KeepAlive.totalTime += (new Date().getTime() - KeepAlive.requestTime);
                KeepAlive.averageTime = (KeepAlive.totalTime/KeepAlive.statusRcvd);
				KeepAlive.averageTime = Math.round(KeepAlive.averageTime);

                // update the keep alive status display
				jQuery("#keepAliveStatus").text("Keep-alive: sent: " + KeepAlive.statusSend + ", rcvd: " + KeepAlive.statusRcvd + ", average time: " + KeepAlive.averageTime + " ms");
            }
        });
    }
};

// register the keep alive init() function with the windows onload event
jQuery(window).bind("load", function()
{
    // do not start the keepalive setInterval if the user is on the homepage and NOT signed in
    if (location.pathname == "/sameside.php" && jQuery("#divUserName").length === 0)
    {
        return;
    }
    KeepAlive.init();
});



