<?php
require_once BASE . '/models/Db.php';
require_once BASE . '/controllers/Qs.php';
class Work{
    use Qs;
    public function getAll(){
        $arResult = [];
        $DB = Db::getInstance();
        $arResult['nav'] = '<nav><ul class="pagination">';
        $query = "SELECT COUNT(*) FROM work";
        $total = 0; //всего записей
        $col = 3;  //количество записей для вывода
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $str = '';
        $q_s = $this->queryString(2);
        if(!empty($q_s)){ $str = '&sort=' . $q_s[0] . '-' . $q_s[1]; }
        if(!is_int($page)){
            $page = 1; // текущая страница
        }

        $art = ($page * $col) - $col;
        if ($result = $DB->query($query)) {
            $total = $result->fetch_assoc()["COUNT(*)"];
        }

        $str_pag = ceil($total / $col);
        for ($i = 1; $i <= $str_pag; $i++){
            $arResult['nav'] .= '<li class="page-item"><a class="page-link" href="' . PATH . '?page=' . $i . $str .'">'  . $i .  '</a></li>';
            
        }

        $field = 'id';
        $sort = 'DESC';
        $ar = $this->queryString(2);
        if(!empty($ar)){
            $field = $ar[0];
            $sort = $ar[1];
        }
        $arResult['nav'] .= '</ul></nav>';        
        $query = "SELECT * FROM work ORDER BY ${field} ${sort} LIMIT ${art}, ${col}";
        if ($result = $DB->query($query)) {
            while ($row = $result->fetch_assoc()) {
                 $arResult['items'][] = $row;
            }
                
                $result->free();
        }
        return $arResult;
    }
    public function updateStatus($id){
        $DB = Db::getInstance();
        $query = "UPDATE work SET status=1 WHERE id=${id}";
        $DB->query($query);
    }
    public function updateText($text, $id){
        $DB = Db::getInstance();
        $query = "UPDATE work SET text='$text' WHERE id=$id";
        $DB->query($query);
    }
    public function insert($name, $email, $text){
        $DB = Db::getInstance();
        $query = "INSERT INTO work (name, email, text) VALUES ('${name}', '${email}', '${text}')";
        return $DB->query($query);
    }
    public function auth($flag){
        $DB = Db::getInstance();
        if($flag == 1){
            $sesid = session_id();
            $query = "UPDATE users SET is_aut='$sesid' WHERE login='admin'";
            $DB->query($query);
        }
        if($flag == 2){
            $query = "UPDATE users SET is_aut='' WHERE login='admin'";
            $DB->query($query);
        }
    }
}