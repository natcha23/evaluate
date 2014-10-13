<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Log
 * @subpackage Writer
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Stream.php 8064 2008-02-16 10:58:39Z thomas $
 */

/** Zend_Log_Writer_Abstract */
require_once 'Workflow/Menu/Abstract.php';

/**
 * @category   Mdt
 * @package    Mdt_Writer
 * @subpackage Writer
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Stream.php 8064 2008-02-16 10:58:39Z thomas $
 */
class Workflow_Menu extends Workflow_Menu_Abstract
{

    var $d_Menu = "back";

    public function topMenuFormat(& $dataArray, & $smarty) {
        if (!is_array($dataArray))
            return "";
       	$lang = ($_COOKIE[LANG])?$_COOKIE[LANG]:"TH";
        $g_image= $smarty->_tpl_vars['g_image'];
        $html= '<div id="@id" align="left">' . "\n";
        $last= end(array_values($dataArray));
        foreach ($dataArray as $index => $record) {
            /*$section_name=unserialize($record[section_name]);
            $record[section_name] = $section_name[$lang];*/
            $record['section_link'] = $record['section_link']."/menu_id/".$record['section_id'];
           /* if ($index >= 6) {
                if ($index == 6) {
                    $html .= '<a href="javascript:void(0);" onMouseOver="MM_swapImage(\'Image' . ($index +1) . '\',\'\',\'' . $g_image . '/m_more_on.gif\',1)" onMouseOut="MM_swapImgRestore()" id="designanchor"><img src="' . $g_image . '/m_more.gif" name="Image' . ($index +1) . '" border="0" id="Image' . ($index +1) . '"></a>' . "\n";
                    $html .= '<div id="mymenu1" class="outlinemenu">' .
                             '<ul>';
                }
                $html .= '<li><a href="#" onclick="app.gotoview(\'' . $record['section_link'] . '\');"><img src="' . $g_image . '/' . $record['section_name'] . '.gif" width="15" hight="15" border="0"/>&nbsp;&nbsp;' . ucfirst($record['section_name']) . '</a></li>';
                if ($index == $last) {
                    $html .= '</ul></div>' . "\n";
                }
            }*/
            if ($index < 6) {
                $_func= $record['section_link'] ? 'app.gotoview(\'' . $record['section_link'] . '\')' : '';
                $html .= '<a href="javascript:' . $_func . ';" >'.$record['section_name'].'</a>' . "\n";
            }
        }
        $html .= '</div>' . "\n";
        return $html;
    }

    public function getHtmlTreeView($params, &$smarty)
	{
		// @todo: acl
		$d_Menu = "back";

		$lang = ($_COOKIE[LANG])?$_COOKIE[LANG]:"TH";
		$first = (is_object($smarty) && $smarty instanceof Smarty);
        $data = $params["data"];

		if ( $first )
		{
			Zend_Registry::get("view")->AddJavaScript("treeview");
			if ( $params["id"] ) $attr .= "id=\"{$params["id"]}\" ";
			if ( $params["class"] ) $attr .= "class=\"{$params["class"]}\" ";
		}

        $front    = Zend_Registry :: get("front");
        $base_url = $front->getBaseUrl();
		$html = "<ul $attr style=\"display:none;\">"; // class=\"filetree\"
		if ($data["children"])
		{
			while ( list(, $menu) = each($data["children"]) )
			{
                /*$menu_text = unserialize($menu["text"]);
                $menu[text] = $menu_text[$lang];
                $menu_href = unserialize($menu["href"]);
                $menu[href] = $menu_href[$d_Menu];*/
                if($menu["href"]){
	                $menu["href"]=$menu["href"]."/menu_id/".$menu["id"];
	                $href = ($menu["href"] && !$menu["children"]) ? "/{$base_url}/{$menu["href"]}" : "javascript:void(0);";
	                $href = str_replace("//","/",$href);
				}

                $class = $menu["children"] ? "folder" : "file";
                // if ( $first ) $class = "folder";

				if($href){
					$html .= "<li><span class=\"$class\"><a href=\"{$href}\">{$menu["text"]}</a></span>";
				}else{
					$html .= "<li><span class=\"$class\">{$menu["text"]}</span>";
				}
				if ( $menu["children"] )
					$html .= self::getHtmlTreeView( array("data" => $menu), $tmp = 0);
				$html .= "</li>";
			}
		}
		$html .= "</ul>";

		if ($first)
		{   // class="init-script"
	        $html .= "\n".'<script type="text/javascript" charset="utf-8" >' ."\n".
                     '    '."\n".
	                 '    $(document).ready(function () {' ."\n".
                     '        $("#'.$params["id"].'").show();'."\n".
	                 '        $("#'.$params["id"].'").treeview({persist:"cookie",cookieId: "treeview-'.$params["id"].'"});' ."\n".
	                 '    });' ."\n".
	                 '</script>';
		}
		return $html;
	}

   /* public function topMenuFormat(&$dataArray, &$smarty) {
        if(!is_array($dataArray)) return "";
        $g_image = $smarty->_tpl_vars['g_image'];
        $html  = '<div id="@id" align="left">'."\n";
        foreach($dataArray as $index=>$record) {
            $_func = $record['section_link']?'app.gotoview(\''.$record['section_link'].'\')':'';
            $html .= '<a href="javascript:'.$_func.';" onMouseOver="MM_swapImage(\'Image'.($index+1).'\',\'\',\''.$g_image.'/m_'.($record['section_name']).'_on.gif\',1)" onMouseOut="MM_swapImgRestore()"><img src="'.$g_image.'/m_'.($record['section_name']).'.gif" name="Image'.($index+1).'" border="0" id="Image'.($index+1).'"></a>'."\n";
        }
        $html .= '</div>'."\n";
        return $html;
    }
    public function topMenuFormat2(&$dataArray) {
        if(!is_array($dataArray)) return "";
		$lang_data =array("1"=>array("code"=>"EN"),"2"=>array("code"=>"TH"));
		foreach($lang_data as $item){
			$text[$item[code]] = "var menubar =[";
			$menu_level[$item[code]]=0;
		}
		$table = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\"><tr><td class=\"main_menu\" style=\"cursor:pointer\">";
		$table_end = "</td></tr></table>";
		foreach($dataArray as $menu_id=>$data){
			if(!$data[section_link]) $data[section_link]="#";
			$data[section_name] = unserialize($data[section_name]);

			foreach($lang_data as $item){
					$lang = $item[code];
					if($data[section_level]>$menu_level[$lang]){
						if($data[section_level]==1){
							$text[$lang] .="['{$data[$this->table_icon]}','".$table.trim($data[section_name][$lang]).$table_end."','".APP_URL."$data[section_link]','_self',null,";
						}else{
							$text[$lang] .="['{$data[$this->table_icon]}','".trim($data[section_name][$lang])."','".APP_URL."$data[section_link]','_self',null,";
						}
					}elseif($data[section_level]==$menu_level[$lang]){
						$len = strlen($text[$lang]);
						$text[$lang] = substr($text[$lang],0,$len-1);
						$text[$lang] .="],";
						if($data[section_level]==1)
							$text[$lang] .="['{$data[$this->table_icon]}','".$table.trim($data[section_name][$lang]).$table_end."','".APP_URL."$data[section_link]','_self',null,";
						else
							$text[$lang] .="['{$data[$this->table_icon]}','".trim($data[section_name][$lang])."','".APP_URL."$data[section_link]','_self',null,";
					}elseif($data[section_level]<$menu_level[$lang]){

						$len = strlen($text[$lang]);
						$text[$lang] = substr($text[$lang],0,$len-1);
						$level = ($menu_level[$lang]-$data[section_level])+1;
						for($i=0;$i<$level; $i++)
							$text[$lang] .="],";
						if($data[section_level]==1)
							$text[$lang] .="['{$data[$this->table_icon]}','".$table.trim($data[section_name][$lang]).$table_end."','".APP_URL."$data[section_link]','_self',null,";
						else
							$text[$lang] .="['{$data[$this->table_icon]}','".trim($data[section_name][$lang])."','".APP_URL."$data[section_link]','_self',null,";
					}
					$menu_level[$lang] = $data[section_level];
			}
		}

		foreach($lang_data as $item){
			$len = strlen($text[$item[code]]);
			$text[$item[code]] = substr($text[$item[code]],0,$len-1);
			for($i=$menu_level[$item[code]];$i>0; $i--){
					$text[$item[code]] .="],";
			}
			$text[$item[code]] .="];";
			$text[$item[code]] .="\n cmDraw ('imenubar', menubar, 'hbr', cmThemeOffice, 'ThemeOffice');";
		}
		return "<script>".$text[$_COOKIE[LANG]]."</script>";

    }*/
}