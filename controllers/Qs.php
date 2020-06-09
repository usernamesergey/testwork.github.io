<?php
trait Qs{
    function queryString($var){
        if(!empty($_SERVER['QUERY_STRING']) && $var == 1){
            $q_s = '';
            parse_str($_SERVER['QUERY_STRING'], $ar);
            if(!empty($ar['page'])){
                $q_s = "page=" . $ar['page'];
            }
            return $q_s;
        }
        if(!empty($_SERVER['QUERY_STRING']) && $var == 2 && !empty(filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING))){
            $q_s = explode('-', $_GET['sort']);
            parse_str($_SERVER['QUERY_STRING'], $q_s);
            if(!empty($q_s['sort'])){
                $q_s = explode('-', $q_s['sort']);
            }else{
                $q_s = '';
            }
            return $q_s;
        }
    }
}