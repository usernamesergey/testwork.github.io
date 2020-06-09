<?php
require_once BASE . '/models/Work.php';
require_once BASE . '/controllers/Qs.php';

class Main{
    use Qs;
    public function init(){
        $work = new Work;
        if(isset($_GET['auth'])){
            require BASE . '/auth.php';
            return;
        }
        if(isset($_GET['exit'])){
            $work->auth(2);
        }
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $arResult = $work->getAll();
            if(!empty($arResult)){
                echo $this->getView($arResult);
            }
        }
        else{
            if(!empty($_POST['amendments']) && !empty($_POST['id'])){
                $is_admin = $this->isAdmin();
                $amendments = null;
                if($is_admin){
                    $text = filter_input(INPUT_POST, 'amendments', FILTER_SANITIZE_STRING);
                    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                    $work->updateText($text, $id);
                    $amendments = $id;
                }
                    $arResult = $work->getAll();
                    $arResult['amendments'] = $amendments;
                    $arResult['is_admin'] = $is_admin;
                    if(!empty($arResult)){
                        echo $this->getView($arResult);
                    }
                
                
            } 
            if(isset($_POST['done'])){
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                if(!$id) throw new Excepion('id не пришел');
                $work->updateStatus($id);
                $arResult = $work->getAll();
                if(!empty($arResult)){
                    echo $this->getView($arResult);
                }
 
            }
            if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['text']) ){
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
                $res = $work->insert($name, $email, $text);
                $arResult = $work->getAll();
                $arResult['success'] = $res;
                if(!empty($arResult)){
                    echo $this->getView($arResult);
                } 
            }
            if(!empty($_POST['auth']) and !empty($_POST['pass'])){
                $auth = trim(filter_input(INPUT_POST, 'auth', FILTER_SANITIZE_STRING));
                $pass = md5(PREFIX . trim(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING)));
                $query = "SELECT * FROM users WHERE login='$auth' and password='$pass'";
                $DB = Db::getInstance();
                if ($result = $DB->query($query)){
                    $rows = $result->num_rows;
                    if($rows > 0){
                        $user = $result->fetch_assoc();
                        $work->auth(1);
                        $arResult = $work->getAll();
                        if(!empty($arResult)){
                            echo $this->getView($arResult);
                        }
                    }else{
                        $error = true;
                        if(file_exists(BASE . '/auth.php')){
                            require BASE . '/auth.php';
                        }else{
                            return false;
                        }
                        
                    }

                }
            
            }
        }
    }

    protected function getView($arResult){
        $is_admin = $this->isAdmin();
        if(file_exists(BASE . '/view/tmp.php')){
            $q_s = $this->queryString(1);
            require BASE . '/view/tmp.php';
        }else{
            throw new Exception('Нет файла ' . BASE . '/view/tmp.php');
        }
    }
    protected function isAdmin(){
        $query = "SELECT is_aut FROM users WHERE is_aut='" . session_id() . "'";
        $DB = Db::getInstance();
        if ($result = $DB->query($query)){
            $rows = $result->num_rows;
            if($rows > 0){
                $user = $result->fetch_assoc();
                return true;
            }else{
                return false;
            }
        }
    }
}