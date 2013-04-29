<?php
if(isset($_POST['postldd'])){
//get post
$newldd=$_POST['date'];

if($newldd==""){$error_console="You must pick a date!";}

if($error_console!=""){
    /*failed*/
    echo $error_console;
    echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
    /*passed*/
    //update the datbase
    mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET launch_day='$newldd'");
    echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
}
} else {
?>
This will change the Launch Day Date that displays on the closed page. The format is XX/XX/XXXX where X's can represent Question Marks (?).
<form action="" method="post">
<div id="formLayoutTableConstruction">
    <div class="formLayoutTableConstructionRow">
        <div class="formLayoutTableConstructionRowLeftCol">
            <label>Launch Day Date</label>
        </div>
        <div class="formLayoutTableConstructionRowRightCol">
            <input type="hidden" name="wtd" value="change_ldd" />
            <script type="text/javascript">
            $(function() {
                $('#popupDatepicker').datepick();
                //$('#inlineDatepicker').datepick({onSelect: showDate});
            });
            </script>
            
            <input type="text" maxlength="10" name="date" id="popupDatepicker" value="<?php echo getGlobalVars($properties,'launch_day');?>" />
        </div>
    </div>                   
    
    <div class="formLayoutTableConstructionRow">
        <div class="formLayoutTableConstructionRowLeftCol">
            
        </div>
        <div class="formLayoutTableConstructionRowRightCol">
            <input type="submit" name="postldd" value="Save" class="submit" />
        </div>
    </div>
</div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}	