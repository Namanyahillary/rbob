Add the following code to enable loading of links by ajax calls at the top of every view chosen

<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>

//To disable a link from subject to ajax request, eg Tabs in bootstrap,
==>add class "no-ajax"

//To Enable Confirmation before sending request
==>add class "confirm-first"
==>add attribute "data-confirm-text" eg data-confirm="Please confirm"

//To display requested data into bootstrap modal, 
==>add class "for-modal"

//To enable javascript for static links outside the "dynamic-content" class container eg those on the navigations,
==>add class "use-ajax"


//To enable javascript for forms outside the "dynamic-content" class container eg those loaded in the pop up modal,
==>add class "form-ajax" to the form

NB:
-Change src for the image in js/script_dynamic_content.js
in showLoading() methode to valid link.

-Change request url for the "get request"in js/script_static_content.js
in fetchNewMessageCount() method to valid link.

