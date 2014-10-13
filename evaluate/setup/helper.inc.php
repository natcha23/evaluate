<?php
function _print($data) {
    if ($data) {
        if (is_array($data) OR is_object($data)) {
            echo "<pre>\n";
            print_r($data);
            echo "</pre>\n";
        } else if(is_bool($data)) {
            var_dump($data);
        } else {
            echo "{$data}<br />\n";
        }
    } else {
        echo "Data is empty\n";
    }
}
function genPagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text=true, $flag=null) {
    $total_pages= ceil($num_items / $per_page);
    $start_item = ($start_item*$per_page)-1;

    if ($total_pages == 1) {
        return '';
    }
    $on_page= floor($start_item / $per_page) + 1;
    $page_string= '';
    if ($total_pages > 10) {
        $init_page_max= ($total_pages > 3) ? 3 : $total_pages;
        for ($i= 1; $i < $init_page_max +1; $i++) {
            $page_string .= ($i == $on_page) ? '<b>[' . $i . ']</b>' : '<a href="' . $base_url . "/page$flag/" . $i . '">' . $i . '</a>';
            if ($i < $init_page_max) {
                $page_string .= ", ";
            }
        }
        if ($total_pages > 3) {
            if ($on_page > 1 && $on_page < $total_pages) {
                $page_string .= ($on_page > 5) ? ' ... ' : ', ';
                $init_page_min= ($on_page > 4) ? $on_page : 5;
                $init_page_max= ($on_page < $total_pages -4) ? $on_page : $total_pages -4;
                for ($i= $init_page_min -1; $i < $init_page_max +2; $i++) {
                    $page_string .= ($i == $on_page) ? '<b>[' . $i . ']</b>' : '<a href="' . $base_url . "/page$flag/" . $i . '">' . $i . '</a>';
                    if ($i < $init_page_max +1) {
                        $page_string .= ', ';
                    }
                }
                $page_string .= ($on_page < $total_pages -4) ? ' ... ' : ', ';
            } else {
                $page_string .= ' ... ';
            }
            for ($i= $total_pages -2; $i < $total_pages +1; $i++) {
                $page_string .= ($i == $on_page) ? '<b>[' . $i . ']</b>' : '<a href="' . $base_url . "/page$flag/" . $i . '">' . $i . '</a>';
                if ($i < $total_pages) {
                    $page_string .= ", ";
                }
            }
        }
    } else {
        for ($i= 1; $i < $total_pages +1; $i++) {
            $page_string .= ($i == $on_page) ? '<b>[' . $i . ']</b>' : '<a href="' . $base_url . "/page$flag/" . $i . '">' . $i . '</a>';
            if ($i < $total_pages) {
                $page_string .= ', ';
            }
        }
    }
    $prevImg= "<img src=\"[image-path]/backend/prev3.gif\" border=0 title=\"Previous\"/>";
    $nextImg= "<img src=\"[image-path]/backend/next3.gif\" border=0 title=\"Next\"/>";
    if ($add_prevnext_text) {
        if ($on_page > 1) {
            $page_string= '<a href="' . $base_url . "/page$flag/" . ($on_page-1) . '">' . $prevImg . '</a>&nbsp;' . $page_string;
        }
        if ($on_page < $total_pages) {
            $page_string .= '&nbsp;<a href="' . $base_url . "/page$flag/" . ($on_page+1) . '">' . $nextImg . '</a>';
        }
    }

    /*
    if ($page_string) {
        $page_string= 'Goto page' . ' ' . $page_string;
        $prevImg = "./modules/globals/templates/default/media/toolsbar/prev3.gif";
        $nextImg = "./modules/globals/templates/default/media/toolsbar/next3.gif";
        $page_string = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><img src=\"{$prevImg}\" /></td><td valign=\"middle\">&nbsp;".$page_string."</td><td><img src=\"{$nextImg}\" /></td></table>";


    }
    */
    return $page_string;
}
function unescape($strIn, $iconv_to= "UTF-8") {
	$strOut= "";
	$iPos= 0;
	$len= strlen($strIn);
	while ($iPos < $len) {
		$charAt= substr($strIn, $iPos, 1);
		if ($charAt == "%") {
			$iPos++;
			$charAt= substr($strIn, $iPos, 1);
			if ($charAt == "u") {
				// Unicode character
				$iPos++;
				$unicodeHexVal= substr($strIn, $iPos, 4);
				$unicode= hexdec($unicodeHexVal);
				$strOut .= code2utf($unicode);
				$iPos += 4;
			} else {
				// Escaped ascii character
				$hexVal= substr($strIn, $iPos, 2);
				if (hexdec($hexVal) > 127) {
					// Convert to Unicode
					$strOut .= code2utf(hexdec($hexVal));
				} else {
					$strOut .= chr(hexdec($hexVal));
				}
				$iPos += 2;
			}
		} else {
			$strOut .= $charAt;
			$iPos++;
		}
	}
	if ($iconv_to != "UTF-8") {
		$strOut= iconv("UTF-8", $iconv_to, $strOut);
	}
	// $strOut = str_replace("{percent}","%", $strOut);
	return $strOut;
}