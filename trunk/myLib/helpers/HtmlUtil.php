<?php
class HtmlUtil  {
    public static function cleanText($string, $except = array('color','text-align', 'font-size','height','width')){
        // remove unwanted style propeties
        $allow = implode($except, '|');
        $regexp = '@([^;"]+)?(?<!'.$allow.'):(?!\/\/(.+?)\/)((.*?)[^;"]+)(;)?@is';
        //$string = preg_replace($regexp, '', $string);
        //$string = preg_replace('@[a-z]*=""@is', '', $string); // remove any unwanted style attributes
        $regexp = '@([^;"]+)?(?<!'.$allow.'):(?!\/\/(.+?)\/)((.*?)[^;"]+)(;)?@is';//this line should be replaced with other gibberish that excludes certain strings of 4 characters...
        $string = preg_replace($regexp, '', $string);
        // remove unwanted style propeties end
        $string = str_replace ( ' style=""', '', $string );
        return $string;
    }
}