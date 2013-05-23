Welcome to your User CP! Here is where you can change all the attributes of your online profile here. 
<form action="" method="post">
    <input type="hidden" name="wtd" value="user_cp" />
    <div id="formLayoutTableConstruction">
        <div class="formLayoutTableConstructionRow">
            <div class="formLayoutTableConstructionRowLeftCol">
                <label>First Name</label>
                <br />
                <label>Last Name</label>
                <br />
                <label>Gender</label>
                <br />
                <label>Password</label>
                
            </div>
            <div class="formLayoutTableConstructionRowRightCol">
                <input type="text" name="ucp_" value="" />
            </div>
        </div>
        
        <div class="formLayoutTableConstructionRow">
            <div class="formLayoutTableConstructionRowLeftCol">
                
            </div>
            <div class="formLayoutTableConstructionRowRightCol">
                <input type="submit" name="user_cp_save" value="Save" class="submit" />
            </div>
        </div>
    </div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
?>