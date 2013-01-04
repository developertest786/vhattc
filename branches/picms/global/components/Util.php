<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Admin
 * Date: 12/5/12
 * Time: 2:31 PM
 * To change this template use File | Settings | File Templates.
 */
class Util
{
    public static function stripUnicode($str){
        if(!$str) return false;
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        }
        return $str;
    }

    public static function genRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';

        $string = '';

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return strtoupper($string);
    }

    public static function currencyFormat( $value, $add_currency=false, $symbol=' VNĐ ')
    {
        if(strlen($value)>2){
            if($value != '' and is_numeric($value))
            {
                $value = number_format ( $value, 2, ',', '.' );
                $value = str_replace ( ',00', '', $value );
            }
        }
        if($add_currency) $value.=' '.$symbol;
        return $value;
    }

}