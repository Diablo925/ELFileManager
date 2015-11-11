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

    static function getConfig()
    {
            global $controller;

            $currentuser = ctrl_users::GetUserDetail(); 
        if(file_exists(ctrl_options::GetSystemOption('hosted_dir') . $currentuser["username"] . "/elfilemanager_config.xml")) { 
        $xml=simplexml_load_file(ctrl_options::GetSystemOption('hosted_dir') . $currentuser["username"] ."/elfilemanager_config.xml");
        $lang = $xml->lang;
        $theme = $xml->theme;
        }
            $themearray = array("default" => "Default theme", "windows-10" => "Windows 10 theme", "moono" => "Moono theme");
			$langarray = array("ar" => "Arabic", "bg" => "Bulgarian", "ca" => "Catalan", "cs" => "Czech", "da" => "Danish",
							   "de" => "German", "el" => "Greek", "en" => "English", "es" => "Spanish", "fa" => "Persian-Farsi", "fr" => "French", "he" => "Hebrew", "hu" => "Hungarian", "id" => "Indonesian", "it" => "Italian", "jp" => "Japanese", "ko" => "Korean", "nl" => "Dutch", "no" => "Norwegian", "pl" => "Polish", "pt_BR" => "Brazilian Portuguese", "ro" => "Romanian", "ru" => "Russian", "sk" => "Slovak", "sl" => "Slovenian", "sr" => "Serbian", "sv" => "Swedish", "tr" => "Turkish", "uk" => "Ukrainian", "vi" => "Vietnamese", "zh_CN" => "Simplified Chinese", "zh_TW" => "Traditional Chinese");
            $res = "<form name=FileManager_config action=./?module=ELFileManager&action=select method=POST>
        <table class='table'>
		<tr>
		<th>Select Theme</th>
		<td>
		<select name=inTheme id=inTheme>
        <option value=''>---- Select a theme ----</option>";
            foreach ($themearray as $value=>$name) { 
			
			if($value == $theme)
    		{
         		$res .= "<option selected=selected value=".$value.">".$name."</option>";
    		}
    	else
    		{
         		$res .= "<option value=".$value.">".$name."</option>";
    		}	
		}
       $res.= "</select></td>
	   </tr>
	   <tr>
		<th>Select Theme</th>
		<td>
		<select name=inLang id=inLang>
        <option value=''>---- Select language ----</option>";
            foreach ($langarray as $value=>$name) { 
			
			if($value == $lang)
    		{
         		$res .= "<option selected=selected value=".$value.">".$name."</option>";
    		}
    	else
    		{
         		$res .= "<option value=".$value.">".$name."</option>";
    		}	
		}
       $res.= "</select></td>
	   </tr><tr>
	   <th></th>
	   <td><button class='btn btn-primary' type='submit' id='button' name='inSave' id='inSave'>Save</button></td>
	   </tr>
	   </table>
        </form>";
        return $res;
    }
		
		static function doselect()
		{
       			global $controller;
        			$formvars = $controller->GetAllControllerRequests('FORM');
                    $currentuser = ctrl_users::GetUserDetail(); 
                    $dir = ctrl_options::GetSystemOption('hosted_dir') . $currentuser['username'];
        			
                    $xml ="<note>\n\t\t";
                    $xml .="<theme>".$formvars["inTheme"]."</theme>\n\t\t";
                    $xml .="<lang>".$formvars["inLang"]."</lang>\n\t\t";
                    $xml .="</note>\n\r";
                    $xmlobj=new SimpleXMLElement($xml);
                    $xmlobj->asXML($dir ."/elfilemanager_config.xml");
					
        		return true;
		}
		
}
?>