<?php
namespace common\seo;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of url
 *
 * @author thuc
 */
class Urlseo {
    public function convertlink($str){
        $str =  strtolower($str);
        $str = preg_replace('/\s\s+/', ' ', trim($str));
        $str = str_replace(",", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace("+", "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace("~", "", $str);
        $str = str_replace("#", "", $str);
        $str = str_replace("@", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("*", "", $str);
        $str = str_replace("!", "", $str);
        $str = str_replace("`", "", $str);
        $str = str_replace("[", "", $str);
        $str = str_replace("]", "", $str);
        $str = str_replace("{", "", $str);
        $str = str_replace("}", "", $str);
        
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
    public function thoigian($time){
        return  ' Ngày '.gmdate("d",$time).
                ' tháng '.gmdate("m",$time).
                ' năm '.gmdate("Y",$time).
                ' vào lúc '.gmdate("H:i:s",$time);
    }
}
