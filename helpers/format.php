<?php 


/**
 * summary
 */
class Format  
{
    /**
     * summary
     */
    public function formateDate($date)
    {
    	return date("F, j, Y, g:i a", strtotime($date));
    }

    public function formatString($string)
    {
    	return strtoupper($string);
    }

    public function shortParagraph($string,$limit=450)
    {
    	$text  = " ";
    	$text .= substr($string,0,$limit);
    	$text .= " ..........";
    	return $text;
    	
    }


    public  function validation($input)
    {
        $text =htmlspecialchars($input);
        $text = strip_tags($input);
        $text = stripslashes($input);
        $text  = trim($input);

        return $text;
    }



}