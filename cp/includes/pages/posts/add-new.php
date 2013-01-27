<h1>Add New Post</h1>
<form action="#addnewpost" method="POST" name="addnewpost_form">
<div class="cp-table">
	<div class="cp-row">
    	<div class="cp-lcol">
            <div id="formLayoutTable">
                <div class="formLayoutTableRow">
                    <div class="formLayoutTableRowLeftCol">
                        <input type="text" name="addnewpost_title" id="addnewpost_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="Enter title here" class="full-input" />
                    </div>
                    <div class="formLayoutTableRowRightCol">
                        
                    </div>
                </div>
                
                <div class="formLayoutTableRow">
                    <div class="formLayoutTableRowLeftCol">
                        <textarea name="addnewpost_content" id="addnewpost_content"></textarea>
                    </div>
                    <div class="formLayoutTableRowRightCol">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="cp-rcol">
        	<div id="formLayoutTable">
                <div class="formLayoutTableRow">
                    <div class="formLayoutTableRowLeftCol">
                        <h2>Publish</h2>
                    </div>
                    <div class="formLayoutTableRowRightCol">
                        
                    </div>
                </div>
                
                <div class="formLayoutTableRow">
                    <div class="formLayoutTableRowLeftCol">
                        <input type="submit" name="addnewpost_savedraft" value="Save Draft" class="submit" />
                    </div>
                    <div class="formLayoutTableRowRightCol">
                        <input type="submit" name="addnewpost_preview" value="Preview" class="submit" />
                    </div>
                </div>
            </div>
            Status: Draft <a href="">Edit</a><br />
            Publish: Immediately <a href="">Edit</a><br />
            Publicize: (social media platforms) <a href="">Edit</a> <a href="">Settings</a><br />
            <div id="formLayoutTable">
                <div class="formLayoutTableRow">
                    <div class="formLayoutTableRowLeftCol">
                        <a href="">Move to Trash</a>
                    </div>
                    <div class="formLayoutTableRowRightCol">
                        <input type="submit" name="addnewpost_publish" value="Publish" class="submit" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>