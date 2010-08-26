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
<!doctype html>
<html>

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <title>keepalive Plugin Demonstration &amp; Documentation</title>

        <!-- CSS : implied media="all" from html5boilerplate [ http://html5boilerplate.com/ ] -->
        <link rel="stylesheet" href="css/style.css">

        <style type="text/css">

            body { background-color: #f6f8f6; line-height:1.3em; }
            body.ie6 { margin-bottom:25px;}
            body.ie7 { margin-bottom:25px;}

            .pageTitle { font-size:150%; color:#6f5544; font-weight:bold; margin:25px 0; text-align:center; }

            .contentContainer {
                visibility:visible; background-color:#fff; padding:20px; margin:0 auto 25px auto; width:750px; border:1px solid #9f8877; position:relative; overflow:hidden;
                -moz-border-radius:8px; -webkit-border-radius:8px;
            }

            .contentContainer p { margin:2em 0 0 0; }

            .pHeader { font-weight:bold; font-size:110%; color:#009; }

            #pageWarning { display:none; color:#d00; }

            .prompt { font-weight:bold; color:#000; margin:0.5em 0 0 1em; }

            .buttonContainer { margin-left:25px; }
            .buttonContainer button { margin-top:8px; }

            .optionsPrompt { font-weight:bold; font-size:110%; color:#009; margin:2em 0 0 0; }

            .options { margin:1em 0 0 25px;}
            .options pre { padding:0; white-space:pre; }

            .bold { font-weight:bold; color:#000; }

            #keepAliveStatus { font-size:70%; color:#000; margin-top:25px; line-height:normal; }
            #displayRelay { position:absolute; font-size:70%; color:#009; line-height:normal; }

        </style>

    </head>


    <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
    <!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
    <!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
    <!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
    <!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->

        <h1 class="pageTitle">jQuery keepalive Plugin Demonstration &amp; Documentation</h1>

        <div class="contentContainer">

            <p>

                Version: 0.9<br>
                Date: 28 July 2010<br>
                License: MIT License or GNU General Public License (GPL) Version 2<br>
                Git repository: [ <a href="http://github.com/waynewalls/jquery.keepalive">http://github.com/waynewalls/jquery.keepalive</a> ]<br><br>

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

            <div class="buttonContainer">

                <button id="toggle">Toogle Status Display</button><br>
                <button id="stop">Stop keepalive</button>
                <button id="start" disabled="disabled">Start keepalive</button><br>
                <button id="interval5">Set Interval to 5s</button>
                <button id="interval10">Set Interval to 10s</button>

            </div>

            <div class="optionsPrompt"> jQuery.keepalive dependencies:</div>

            <div class="options" style="margin-top:0.75em;">

                requires jQuery v1.4;  there are no other dependencies.

            </div>

            <div class="optionsPrompt"> jQuery.keepalive usage:</div>

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

            <div class="optionsPrompt"> jQuery.keepalive options (type) [ default value ]:</div>

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

            <div class="optionsPrompt"> jQuery.keepalive public methods:</div>

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

            <div class="options">

                <pre>$.keepalive.<span class="bold">toggleDisplay</span>()</pre>
                Toggles the keepalive status display.  The display is appended to the body element.

            </div>
        
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
