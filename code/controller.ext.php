<?php

class module_controller extends ctrl_module
{
	/* Load JS */
    static function getInit() {
        global $controller;
        $line = '';
        $line .= '<!-- iframe by TGates -->
            <script language="JavaScript">
            <!--
            function autoResize(id){
                var newheight;
                var newwidth;

                if(document.getElementById){
                    newheight = document.getElementById(id).contentWindow.document .body.scrollHeight;
                    newwidth = document.getElementById(id).contentWindow.document .body.scrollWidth;
                }

                document.getElementById(id).height = (newheight) + "px";
                document.getElementById(id).width = (newwidth) + "px";
            }
            //-->
            </script>'; 
        return $line;
    }

		
	static function getUserID() 
   	{ 
      		global $controller; 
			$currentuser = ctrl_users::GetUserDetail(); 
			$userid = $currentuser['userid']; 
			return $userid; 
	}
	
	static function getisShowFM()
		{
        global $controller;
        $urlvars = $controller->GetAllControllerRequests('URL');
        return (isset($urlvars['show'])) && ($urlvars['show'] == "ShowFM");
		}
		
		static function doselect()
		{
       			global $controller;
        			$formvars = $controller->GetAllControllerRequests('FORM');
        			if (isset($formvars['inOpen'])) {
                		header("location: ./?module=" . $controller->GetCurrentModule() . '&show=ShowFM');
                		exit;
            		}
            		if (isset($formvars['inClose'])) {
                		header("location: ./?module=" . $controller->GetCurrentModule());
                		exit;
            		}

        		return true;
		}
}
?>