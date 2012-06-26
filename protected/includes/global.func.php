<?php

/*************************************************************
*
*  使用特定function对数组中所有元素做处理
*  @param  string  &$array     要处理的字符串
*  @param  string  $function   要执行的函数
*  @return boolean $apply_to_keys_also     是否也应用到key上
*  @access public
*
*************************************************************/
 
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if ($recursive_counter > 1000) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) 
	{
        if (is_array($value)) 
		{
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        }
		else 
		{
            $array[$key] = $function($value);
        }
  
        if ($apply_to_keys_also && is_string($key))
		{
            $new_key = $function($key);
            if ($new_key != $key) 
			{
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}

//JSON use Chinese
function JSON($array) 
{
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
}

//Response JSON
function responseJSON($JSON)
{
	header('Content-type: application/json');
	print_r($JSON);
}


//Trim UTF-8 Chinese
function utf8Substr($str, $from, $len)
{
    return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
}

//Judge if the string format JSON
function isJSON($str)
{
	return (gettype(json_decode($str,true)) != "array")?false:true;
}

//Judge the id 
function validateId($id)
{
	return (is_numeric($id)&&strlen($id)<11)?true:false;
}

//Judge the contact_method
function validateContactMethod($contact_method)
{
	return strlen($contact_method)>100?false:true;
}

//Judge the site_mark
function validateSiteMark($site_mark)
{
	return ($site_mark>5||$site_mark<1)?false:true;
}

//Judge the product_id
function validateProductId($product_id)
{
	return preg_match('/^[0-9a-zA-Z]{0,50}$/',$product_id)?true:false;
}

?>