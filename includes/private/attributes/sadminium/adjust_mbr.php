<?php
if(isset($_POST['adjust_mbr'])){
    //get post
    $newmbr=$_POST['mbr'];
    
    if($error_console!=""){
        /*failed*/
        echo $error_console;
        echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
    } else {
        /*passed*/
        //update the datbase
        mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_closed_beta_positions='$newmbr'");
        echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
    }
} else {
?>
Use of this form is to allow you as an admin to change the amount of positions open for Closed BETA Members
<form action="" method="post">
    <div id="formLayoutTable">
        <div class="formLayoutTableRow">
            <div class="formLayoutTableRowLeftCol">
                <label>Max BETA Member Rate</label>
            </div>
            <div class="formLayoutTableRowRightCol">
                <input type="hidden" name="wtd" value="adjust_mbr" />
                <input type="number" name="mbr" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_closed_beta_positions');?>" />
            </div>
        </div>                   

        
        <div class="formLayoutTableRow">
            <div class="formLayoutTableRowLeftCol">
                
            </div>
            <div class="formLayoutTableRowRightCol">
                <input type="submit" name="adjust_mbr" value="Save" class="submit" />
            </div>
        </div>
    </div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}