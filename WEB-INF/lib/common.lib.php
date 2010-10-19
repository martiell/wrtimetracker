<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors: Igor Melnik <igor.melnik@mail.ru>
// +----------------------------------------------------------------------+

	/**
	 * @return unknown
	 * @param file unknown
	 * @param version = "" unknown
	 * @desc Loads a class
	 */
	function import( $class_name ) {
	    $libs = array(
			dirname($_SERVER["SCRIPT_FILENAME"]),
			LIBRARY_DIR
		);

	    $pos = strpos($class_name, ".");
        if (!($pos === false)) {
            $peaces = explode(".", $class_name);
            $p = "";
            for ($i=0; $i<count($peaces)-1; $i++) {
                $p = $p . "/" . $peaces[$i];
            }
			$libs = array_merge(array(LIBRARY_DIR . $p),$libs);
            $class_name = $peaces[count($peaces)-1];
        }

		$filename = $class_name . '.class.php';

		foreach($libs as $lib) {
			$inc_filename = $lib . '/' . $filename;
			if (file_exists($inc_filename)) {
					require_once($inc_filename);
					return $class_name;
			}
		}

		print '<br><b>load_class: error load file "'.$filename.'"</b>';
		die();
	}

	function mu_sort($array, $key_sort) {
		$n = 0;
		if (!is_array($array) || count($array)==0)
			return array();

		$key_sorta = explode(",", $key_sort);
		$keys = array_keys($array[0]);

		for($m=0; $m < count($key_sorta); $m++) {
			$nkeys[$m] = trim($key_sorta[$m]);
		}
		$n += count($key_sorta);

		for($i=0; $i < count($keys); $i++) {
			if(!in_array($keys[$i], $key_sorta)) {
				$nkeys[$n] = $keys[$i];
				$n += "1";
			}
		}

		for($u=0;$u<count($array); $u++) {
			$arr = $array[$u];
			for($s=0; $s<count($nkeys); $s++) {
				$k = $nkeys[$s];
				$output[$u][$k] = $array[$u][$k];
			}
		}
		sort($output);
		return $output;
	}

	/**
	 * return float type
	 *
	 * @param unknown $value
	 * @return unknown
	 */
	function toFloat($value) {
		if (isset($value) && strlen($value)>0) {
			$value = str_replace(",",".",$value);
			return floatval($value);
		}
		return null;
	}

	function stripslashes_deep($value) {
	    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);
    	return $value;
	}

	function addslashes_deep($value) {
	    $value = is_array($value) ?
                array_map('addslashes_deep', $value) :
                addslashes($value);
    	return $value;
	}

	function &getConnection() {
        if (!isset($GLOBALS["_MDB2_CONNECTION"])) {

        	require_once('MDB2.php');

        	$mdb2 = &MDB2::connect(DSN);
			if (PEAR::isError($mdb2)) {
    			die($mdb2->getMessage());
			}

			$mdb2->setOption('debug', true);
			$mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);

   			$GLOBALS["_MDB2_CONNECTION"] = &$mdb2;
    	}
      	return $GLOBALS["_MDB2_CONNECTION"];
	}


	function closeConnection() {
		if (isset($GLOBALS["_DB_CONNECTION"])) {
			$GLOBALS["_DB_CONNECTION"]->close();
			unset($GLOBALS["_DB_CONNECTION"]);
		}
	}

	function getFileList($dir, $searchpattern, $hidefilepattern) {
		$fileList = array();
		$d = @opendir($dir);
		while (($file = @readdir($d))) {
			if (@is_dir($dir."/".$file) && ($file != ".") && ($file != "..")) {
				//
			} else if (ereg(strtolower($searchpattern), strtolower($file)) && !ereg($hidefilepattern, $file)) {
				//$fileList[] = $dir."/".@basename($file);
				$fileList[] = @basename($file);
			}
      	}
      	@closedir($d);
      	return $fileList;
	}

/**
* Takes an UTF-8 string and returns an array of ints representing the
* Unicode characters. Astral planes are supported ie. the ints in the
* output can be > 0xFFFF. Occurrances of the BOM are ignored. Surrogates
* are not allowed.
*
* If $strict is set to true the function returns false if the input
* string isn't a valid UTF-8 octet sequence and raises a PHP error at
* level E_USER_WARNING
*
* Note: this function has been modified slightly in this library to
* trigger errors on encountering bad bytes
*
* @author <hsivonen@iki.fi>
* @author Harry Fuecks <hfuecks@gmail.com>
* @param  string  UTF-8 encoded string
* @param  boolean Check for invalid sequences?
* @return mixed array of unicode code points or FALSE if UTF-8 invalid
* @see    unicode_to_utf8
* @link   http://hsivonen.iki.fi/php-utf8/
* @link   http://sourceforge.net/projects/phputf8/
*/
function utf8_to_unicode($str,$strict=false) {
     $mState = 0;     // cached expected number of octets after the current octet
                      // until the beginning of the next UTF8 character sequence
      $mUcs4  = 0;     // cached Unicode character
      $mBytes = 1;     // cached expected number of octets in the current sequence

      $out = array();

      $len = strlen($str);

      for($i = 0; $i < $len; $i++) {

          $in = ord($str{$i});

          if ( $mState == 0) {

              // When mState is zero we expect either a US-ASCII character or a
              // multi-octet sequence.
              if (0 == (0x80 & ($in))) {
                  // US-ASCII, pass straight through.
                  $out[] = $in;
                  $mBytes = 1;

              } else if (0xC0 == (0xE0 & ($in))) {
                   // First octet of 2 octet sequence
                   $mUcs4 = ($in);
                   $mUcs4 = ($mUcs4 & 0x1F) << 6;
                   $mState = 1;
                   $mBytes = 2;

               } else if (0xE0 == (0xF0 & ($in))) {
                   // First octet of 3 octet sequence
                   $mUcs4 = ($in);
                   $mUcs4 = ($mUcs4 & 0x0F) << 12;
                   $mState = 2;
                   $mBytes = 3;

               } else if (0xF0 == (0xF8 & ($in))) {
                   // First octet of 4 octet sequence
                   $mUcs4 = ($in);
                   $mUcs4 = ($mUcs4 & 0x07) << 18;
                   $mState = 3;
                   $mBytes = 4;

               } else if (0xF8 == (0xFC & ($in))) {
                   /* First octet of 5 octet sequence.
                    *
                    * This is illegal because the encoded codepoint must be either
                    * (a) not the shortest form or
                    * (b) outside the Unicode range of 0-0x10FFFF.
                    * Rather than trying to resynchronize, we will carry on until the end
                    * of the sequence and let the later error handling code catch it.
                    */
                   $mUcs4 = ($in);
                   $mUcs4 = ($mUcs4 & 0x03) << 24;
                   $mState = 4;
                   $mBytes = 5;

               } else if (0xFC == (0xFE & ($in))) {
                   // First octet of 6 octet sequence, see comments for 5 octet sequence.
                   $mUcs4 = ($in);
                   $mUcs4 = ($mUcs4 & 1) << 30;
                   $mState = 5;
                   $mBytes = 6;

               } elseif($strict) {
                   /* Current octet is neither in the US-ASCII range nor a legal first
                    * octet of a multi-octet sequence.
                    */
                   trigger_error(
                           'utf8_to_unicode: Illegal sequence identifier '.
                               'in UTF-8 at byte '.$i,
                           E_USER_WARNING
                       );
                   return FALSE;

               }

           } else {

               // When mState is non-zero, we expect a continuation of the multi-octet
               // sequence
               if (0x80 == (0xC0 & ($in))) {

                   // Legal continuation.
                   $shift = ($mState - 1) * 6;
                   $tmp = $in;
                   $tmp = ($tmp & 0x0000003F) << $shift;
                   $mUcs4 |= $tmp;

                   /**
                    * End of the multi-octet sequence. mUcs4 now contains the final
                    * Unicode codepoint to be output
                    */
                   if (0 == --$mState) {

                       /*
                        * Check for illegal sequences and codepoints.
                        */
                       // From Unicode 3.1, non-shortest form is illegal
                       if (((2 == $mBytes) && ($mUcs4 < 0x0080)) ||
                           ((3 == $mBytes) && ($mUcs4 < 0x0800)) ||
                           ((4 == $mBytes) && ($mUcs4 < 0x10000)) ||
                           (4 < $mBytes) ||
                           // From Unicode 3.2, surrogate characters are illegal
                           (($mUcs4 & 0xFFFFF800) == 0xD800) ||
                           // Codepoints outside the Unicode range are illegal
                           ($mUcs4 > 0x10FFFF)) {

                           if($strict){
                               trigger_error(
                                       'utf8_to_unicode: Illegal sequence or codepoint '.
                                           'in UTF-8 at byte '.$i,
                                       E_USER_WARNING
                                   );

                               return FALSE;
                           }

                       }

                       if (0xFEFF != $mUcs4) {
                           // BOM is legal but we don't want to output it
                           $out[] = $mUcs4;
                       }

                       //initialize UTF8 cache
                       $mState = 0;
                       $mUcs4  = 0;
                       $mBytes = 1;
                   }

               } elseif($strict) {
                   /**
                    *((0xC0 & (*in) != 0x80) && (mState != 0))
                    * Incomplete multi-octet sequence.
                    */
                   trigger_error(
                           'utf8_to_unicode: Incomplete multi-octet '.
                           '   sequence in UTF-8 at byte '.$i,
                           E_USER_WARNING
                       );

                   return FALSE;
               }
           }
       }
       return $out;
   }

function decimal_to_time($a)
{
  $val = floatval($a);

  if ($val < 0) {
    $val = 0;
  }

  $mins = round($val * 60);
  $hours = (string)((int)($mins / 60));
  $mins = (string)($mins % 60);
  if (strlen($hours) == 1) {
    $hours = '0' . $hours;
  }
  if (strlen($mins) == 1) {
    $mins = '0' . $mins;
  }

  return "$hours:$mins";
}

function time_to_decimal($a) {
  $tmp = explode(":", $a);
  if($tmp[1]{0}=="0") $tmp[1] = $tmp[1]{1};

  $m = round($tmp[1]*100/60);

  if($m<10) $m = "0".$m;
  $time = $tmp[0].".".$m;
  return $time;
}

function sec_to_time_fmt_hm($sec)
{
  return sprintf("%d:%02d", $sec / 3600, $sec % 3600 / 60);
}

function magic_quotes_off()
{
  if (get_magic_quotes_gpc()) {
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
  }
}


function mdb2_quote($mdb2, $val)
{
  if (!is_array($val)) {
    return str_replace(array('?', '!', '&'), array('\?', '\!', '\&'), $mdb2->quote($val));
  } else {
    foreach ($val as &$v) {
      $v = mdb2_quote($mdb2, $v);
    }
    return $val;
  }
}


function load_dl($needed, $required=true)
{
  if (!extension_loaded($needed))
  {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
    {
      @dl("php_{$needed}.dll");
    }
    else
    {
      @dl("{$needed}.so");
    }

    if ( $required && !extension_loaded($needed) )
    {
      die( "PHP extension '{$needed}' is required but is not loaded. Read Anuko Time Tracker Installation Guide for help." );
    }
  }
}

?>