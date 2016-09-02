<?php

namespace App\Http\Controllers;

use App\Http\Model\UserModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    const UNKNOW  = -10000;

    const SUCCESS = 1;

    const DB_INSERT_ERROR = 1000;
    const DB_UPDATE_ERROR = 1001;
    const DB_SELECT_ERROR = 1002;
    const PARAM_ERROR     = 1003;


    public function showUsers(){
        $vdata = '';

        $errorId  = self::UNKNOW;

        $userId = intval(Input::get('user_id',''));

        $page = intval(Input::get('page',''));

        $limit = intval(Input::get('rows',''));

        $total = UserModel::getUserTotalNum($userId);

        $result = UserModel::getUser($userId, $page, $limit);

        if (is_array($result)) {
            $errorId = self::SUCCESS;
            $vdata = $result;
        } else {
            $errorId = self::DB_SELECT_ERROR;
            $vdata = [];
        }


        return Response::json(array('rows'=>$vdata,'total'=>$total));
    }

    public function addUsers(){
        $errorId  = self::UNKNOW;

        $userId   = time();

        $userName = Input::get('u_name','');

        $phone    = Input::get('u_phone','');

        $email    = Input::get('u_email','');


        $userInfo['u_id']          = $userId;
        $userInfo['u_name']        = $userName;
        $userInfo['u_phone']       = $phone;
        $userInfo['u_email']       = $email;
        $userInfo['u_create_time'] = time();

        if(empty($phone) || $this->_isTel($phone)) {
            if(empty($email) || $this->_isMail($email)) {
                $result = UserModel::addUser($userInfo);
                if ($result) {
                    $errorId = self::SUCCESS;
                } else {
                    $errorId = self::DB_INSERT_ERROR;
                }
            }else{
                $errorId = self::PARAM_ERROR;
            }
        }else{
            $errorId = self::PARAM_ERROR;
        }
        return Response::json(array('error_id'=>$errorId,'vdata'=>[],'error_desc'=>''));
    }

    public function modifyUsers(){
        $errorId  = self::UNKNOW;

        $userId = Input::get('u_id','');

        $userName = Input::get('u_name','');

        $phone    = Input::get('u_phone','');

        $email    = Input::get('u_email','');

        $userInfo['u_name']        = $userName;
        $userInfo['u_phone']       = $phone;
        $userInfo['u_email']       = $email;
        $userInfo['u_create_time'] = time();

        if(!empty($userId) && is_numeric($userId) && is_array($userInfo)){
            $result = UserModel::modifyUser($userId,$userInfo);

            if($result){
                $errorId = self::SUCCESS;
            }else{
                $errorId = self::DB_INSERT_ERROR;
            }
        }else{
            $errorId = self::PARAM_ERROR;
        }

        return Response::json(array('error_id'=>$errorId,'vdata'=>[],'error_desc'=>''));
    }

    public function delUsers(){
        $errorId = self::UNKNOW;

        $userId = Input::get('u_ids','');

        $arrUids = explode(',',rtrim($userId,','));

        if($this->_isUserId($arrUids)){
            if(UserModel::delUser($arrUids)){
                $errorId = self::SUCCESS;
            }else{
                $errorId = self::DB_UPDATE_ERROR;
            }
        }else{
            $errorId = self::PARAM_ERROR;
        }

        return Response::json(array('error_id'=>$errorId,'vdata'=>[],'error_desc'=>''));

    }

    private function _isUserId($userId){
        $result = true;

        if(is_array($userId)){
            foreach($userId as $v){
                if(!is_numeric($v) || empty($v)){
                    $result =  false;
                }
            }
        }else{
            if(!is_numeric($userId) || empty($userId)){
                $result = false;
            }
        }

        return $result;
    }

    private function _isTel(){
        return true;
    }

    private function _isMail(){
        return true;
    }
}
