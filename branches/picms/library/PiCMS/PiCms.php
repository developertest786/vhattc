<?php
class PiCms
{
    public static $registry = array();
    /**
     * @param $category
     * @param $message
     * @param array $params
     * @param null $source
     * @param null $language
     * @return string
     */
    public static function _($category,$message,$params=array(),$source=null,$language=null) {
        if (array() == $params) {
            return $message;
        }
    }

    /**
     * @return PiDocument
     */
    public static function getDocument()
    {
        if (!isset(self::$registry['document']) || null == self::$registry['document']) {
            self::$registry['document'] = new PiDocument();
        }
        return self::$registry['document'];
    }
}
