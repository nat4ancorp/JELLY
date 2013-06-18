<?php
if(getGlobalVars($properties,'display_social_modal')=="yes"){
?>
<div id="fb_popup" style="display:none;" class="fb-popup">
<center>
    <h1>Thank you for visiting my site!</h1>
    <h3>This website sure took a long time to build. Many, many, trials and headaches. :( But it was all worth it. Please Like me so that I can grow my site and provide you with the best!</h3>    
    <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FNat4an-Web-Design%2F514992495212736&amp;send=false&amp;layout=standard&amp;width=500&amp;show_faces=true&amp;font=lucida+grande&amp;colorscheme=light&amp;action=like&amp;height=80&amp;appId=359704224136883" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:100px;" allowTransparency="true"></iframe>

    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <g:plus href="https://plus.google.com/111222572366094728312" rel="author"></g:plus>
    
    <a href="https://twitter.com/nat4ancorp" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @nat4ancorp</a>
    <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <br /> 
    <form id="dismissForm" action="">
        <fieldset>
            <legend>Options</legend>
            NOTE: You may opt out of receiving this message if you would like but if you choose not to opt out, <b>you will see this message with every page load</b>. It's best to just share and like this page then tick the checkbox below to help both of us out. :)
            <br />
            <input id="typeOfUser" name="typeOfUser" type="hidden" value="<?php if($logged==1){?>user<?php }else{?>temp<?php }?>" />
            <input id="loggedSession" name="loggedSession" type="hidden" value="<?php echo $logged_session;?>" />
            <input id="dismissCheck" name="dismissCheck" type="checkbox" value="yes" />	
            <label for="dismissCheck"><b>I do not want to see this message again</b></label>
            <br />
       </fieldset>
       <script type="text/javascript">
	   function closeP(id){
		   $('#'+id).bPopup().close();
	   }
	   </script>
       <button onclick="closeP('fb_popup')">Close Me</button>
       <br />
        <div id="message"></div>
    </form>
    <script type="text/javascript">
        //var to hold the request
        var request;
        
        //bind to the submit event of our form
        $("#dismissForm").submit(function(event){
            //abort any pending request
            if (request) {
                request.abort();	
            }
            //setup some local variables
            var $form = $(this);
            //let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");
            //serialize the data in the form
            var serializeData = $form.serialize();
            
            //let's disable the inputs for the duration of the ajax request
            $inputs.prop("disabled", true);
            
            //fire off the request to /form.php
            var request = $.ajax({
                url: "<?php echo $WEBSITE_URL;?>includes/private/attributes/updateDB.php",
                type: "POST",
                data: serializeData,
                success: function(data){
                    if(data == 'yes'){/*$("#message").html("Okay, I won't display anymore for you on this computer. :(");*/$("#fb_popup").bPopup().close();}
                    else if(data == 'no'){/*$("#message").html("Alright! I will be here for you. :)");alert(data);*/$("#fb_popup").bPopup().close();}
                }
            });
            
            //callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                //log a message to the console
                console.log("Hooray, it worked!");	
            });
            
            //callback handler that will be called on failure
            request.fail(function(jqXHR, textStatus, errorThrown){
                //log the error to the console
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });
            
            //callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function() {
                //reenable the inputs
                $inputs.prop("disabled",false);
            });
            
            //prevent default posting of form
            event.preventDefault();
        });
    </script>
</center>
</div>

<script type="text/javascript">
// Semicolon (;) to ensure closing of earlier scripting
// Encapsulation
// $ is assigned to jQuery
;(function($) {

     // DOM Ready
    $(function() {

        $('#fb_popup').bPopup({
            appendTo: 'body'
            , modalClose: false
            , modalColor: 'gray'
        });

    });

})(jQuery);
</script>
<?php
} else {
/* SOCIAL MODAL TURNED OFF */	
}