<?PHP

if (function_exists ('ini_set'))
{
   //Use cookies to store the session ID on the client side
   @ ini_set ('session.use_only_cookies', 1);
   //Disable transparent Session ID support
   @ ini_set ('session.use_trans_sid',    0);
}

session_name("keepalive");
session_start();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <title>keepalive Plugin Demonstration &amp; Documentation</title>

        <style type="text/css">

            body { font-size:85%; font-family:arial, helvetica, sans-serif; line-height:1.35em; }

            pre { font-size:108%; }

            .bold { font-weight:bold; font-size:125%; color:#009; }

            .pHeader { font-weight:bold; color:#009; }

            .prompt { font-weight:bold; color:#009; margin:0 0 0.15em 0; }

            .container { margin-left:1em; line-height:1.75em; }

            #pageWarning { display:none; color:#d00; }

            button { margin:1em 0 0 0.5em; }

            .optionsPrompt { font-weight:bold; color:#009; margin:2em 0 0 0; }
            .options { margin:2em 0 0 1em; line-height:0.75em; }

            #keepAliveStatus { font-size:70%; color:#009; margin-top:25px; line-height:normal; }
            #displayRelay { position:absolute; font-size:70%; color:#009; line-height:normal; }

        </style>

        <!--[if IE]>

            <style type="text/css">

                pre { font-size:100%; }
                .bold { font-weight:bold; font-size:110%; color:#009; }

            </style>

        <![endif]-->

    </head>


    <body>

        <h3>jQuery keepalive Plugin Demonstration &amp; Documentation</h3>

        <p>

            <a href="http://github.com/waynewalls/jquery.keepalive">http://github.com/waynewalls/jquery.keepalive</a><br><br>

            Version: 0.9<br>
            Date: 28 July 2010<br>
            License: MIT License or GNU General Public License (GPL) Version 2<br><br>

            <span class="pHeader">Background. </span>This plugin sends ajax requests to the server at configurable
            intervals to keep a PHP session from expiring.

        </p>

        <p>

            <span class="pHeader">Limitations. </span>none.

        </p>

        <p>

            <span class="pHeader">How to use this demonstration. </span>jQuery.keepalive is started automatically.
            The default interval for contacting the server is 5-minutes.  Since keepalive does no error checking
            on the ajax request (in order to keep keepalive as unobtrusive as possible), the 5-minute interval allows 2
            failed keepalive connections in a row while still maintaining a 20-minute contact interval&mdash;which
            keeps most PHP sessions from expiring.  For debugging purposes you can toggle a status display which is appended
            to the body element (The toggle option below relays the status display just to the right of the button).
            <span id="pageWarning">(Your browser appears to have cookies disabled. Session cookies are required for
            the keepalive plug-in.)</span>

        </p>

        <div class="prompt">Select an option...</div>

        <div class="container">

            <button id="toggle">Toogle Status Display</button><br>
            <button id="stop">Stop keepalive</button>
            <button id="start" disabled="disabled">Start keepalive</button><br>
            <button id="interval5">Set Interval to 5s</button>
            <button id="interval10">Set Interval to 10s</button>

        </div>

        <div class="optionsPrompt">keepalive dependencies:</div>

        <div class="options" style="margin-top:0.75em;">

            requires jQuery v1.4;  there are no other dependencies.

        </div>

        <div class="optionsPrompt">keepalive usage:</div>

        <div class="options" style="margin-top:0.75em;">

            jQuery.keepalive is started automatically when the plug-in is included a page.

        </div>

        <div class="options">

            <pre>$.keepalive.configure( config )</pre>
            where config is an object containing keepalive options.

        </div>

        <div class="options">

            <pre>$.keepalive.stop()  // stop the keepalive interval timer</pre>

        </div>

        <div class="options">

            <pre>$.keepalive.start( config )  // start the keepalive interval timer</pre>
            where config is an optional object containing keepalive options.

        </div>

        <div class="options">

            <pre>$.keepalive.toggleDisplay()  // toggle the keepalive status display</pre>
            the status display is appended to the body element

        </div>

        <div class="optionsPrompt">keepalive options (type) [ default value ]:</div>

        <div class="options" style="margin-top:0.75em;">

            <pre>$.keepalive.options.<span class="bold">url</span> (string) [ "php/keepalive.php" ]</pre>
            The URL to assign to the $.ajax() URL property

        </div>

        <div class="options">

            <pre>$.keepalive.options.<span class="bold">dataObject</span> (object) [ { id:"keepalive" } ]</pre>
            An object to be assigned to the $.ajax() data property

        </div>

        <div class="options">

            <pre>$.keepalive.options.<span class="bold">interval</span> (integer) [ 300000 ]</pre>
            The interval between requests to the server in milliseconds (default is 5-minutes)

        </div>

        <div class="options">

            <pre>$.keepalive.options.<span class="bold">timeout</span> (integer) [ 20000 ]</pre>
             An integer to be assigned to the $.ajax() timeout property

        </div>

        <div class="options">

            <pre>$.keepalive.options.<span class="bold">errorCallback</span> (function()) [ null ]</pre>
            A function that will be called when the keepalive $.ajax() request returns an error.

        </div>

        <div class="options">

            <pre>$.keepalive.options.<span class="bold">successCallback</span> (function()) [ null ]</pre>
            A function that will be called after each successful keepalive $.ajax() request.

        </div>

        <div class="optionsPrompt">keepalive public methods:</div>

        <div class="options" style="margin-top:0.75em;">

            <pre>$.keepalive.<span class="bold">configure</span>( config )</pre>
            sets keepalive options where config is an object containing new options that will act as default values
            for subsequent ajax requests.

        </div>

        <div class="options">

            <pre>$.keepalive.<span class="bold">stop</span>()</pre>
            Stops the keepalive interval timer.

        </div>

        <div class="options">

            <pre>$.keepalive.<span class="bold">start</span>()</pre>
            Starts the keepalive interval timer.

        </div>

        <div class="options" style="margin-bottom:2em;">

            <pre>$.keepalive.<span class="bold">toggleDisplay</span>()</pre>
            Toggles the keepalive status display.  The display is appended to the body element.
            
        </div>


        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js">
            // load jQuery from Google's CDN
        </script>

        <script type="text/javascript" src="jquery/ka-combined.min.js">
            // load the jquery.hoverIntent and jquery.cookie plugin
        </script>

        <script type="text/javascript" src="jquery.keepalive.min.js">
            // load the jquery.keepalive plugin
        </script>


        <script type="text/javascript">


            // check to see if cookies are enabled
            ( function($) {

                var enabled = false;

                // try to set a cookie
                $.cookie("test", "enabled");

                // try to retrieve it
                enabled = $.cookie("test");

                if (enabled) {

                    // delete the test cookie
                    $.cookie("test", null);
                }
                else {

                    $("#pageWarning").css( { display:"inline" } );
                }

            }(jQuery) );


            ( function($) {

                var pageLoad = {

                    eventHandler_buttons : function() {

                        $("#toggle").bind("click", function() {

                            var displayActive = ($("#keepAliveStatus").length == 1),
                                button = $(this);

                            $.keepalive.toggleDisplay();

                            if (displayActive) {

                                $("#displayRelay").remove();

                            }
                            else {

                                $("<div />", {
                                    id : "displayRelay",
                                    css: { top:button.offset().top, left:button.offset().left + button.width() + 25 },
                                    html: $("#keepAliveStatus").html()
                                }).appendTo(document.body);

                            }

                        });

                        $("#stop").bind("click", function() {

                            var displayActive = ($("#keepAliveStatus").length == 1);

                            $.keepalive.stop();

                            this.disabled = true;

                            $("#start").removeAttr("disabled");

                            if (displayActive) {

                                $("#displayRelay").html($("#keepAliveStatus").html());

                            }

                        });

                        $("#start").bind("click", function() {

                            var displayActive = ($("#keepAliveStatus").length == 1);

                            $.keepalive.start();

                            this.disabled = true;

                            $("#stop").removeAttr("disabled");

                            if (displayActive) {

                                $("#displayRelay").html($("#keepAliveStatus").html());

                            }

                        });

                        $("#interval5").bind("click", function() {

                            var displayActive = ($("#keepAliveStatus").length == 1);

                            $.keepalive.configure( {interval : 5000 } );

                            if (displayActive) {

                                $("#displayRelay").html($("#keepAliveStatus").html());

                            }

                        });

                        $("#interval10").bind("click", function() {

                            var displayActive = ($("#keepAliveStatus").length == 1);

                            $.keepalive.configure( {interval : 10000 } );

                            if (displayActive) {

                                $("#displayRelay").html($("#keepAliveStatus").html());

                            }

                        });

                    }

                };

                $(window).bind("load", function() {

                    pageLoad.eventHandler_buttons();

                    $.keepalive.configure( {

                        successCallback : function() {

                            var kaStatus = $("#keepAliveStatus"),
                                displayActive = (kaStatus.length == 1);

                            if (displayActive) {

                                $("#displayRelay").html(kaStatus.html());

                            }
                        },

                        errorCallback : function() {

                            var kaStatus = $("#keepAliveStatus"),
                                displayActive = (kaStatus.length == 1);

                            if (displayActive) {

                                $("#displayRelay").html(kaStatus.html());

                            }
                        }

                    } );

                });

            }(jQuery) );

        </script>

    </body>

</html>
