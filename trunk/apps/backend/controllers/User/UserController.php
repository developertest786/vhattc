<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 27/11/2012
 * Time: 10:29
 * To change this template use File | Settings | File Templates.
 */
class UserController extends BackendController
{
	public $obj = '';
    public $view = '';
    public $url_path = '';

    public function beforeExecute(){
        $this->url_path = Ming_Factory::getDocument()->getBaseUrl().'auth/sign_in';
    }
    public function executeDefault() {
        $user = Ming_Factory::getSession()->get('auth');
        if(!$user){
            $this->getRequest()->redirect($this->url_path);
        }
        $view = Ming_Factory::getView();
        $wh = '1=1';
        //filter
        $datas = Users::findBy('');
        $view->assign('datas', $datas);
        //echo (uniqid(time(),true));die;
    }

    public function executeEdit() {
        $id = Ming_Factory::getRequest()->get('id', Ming_Filter::TYPE_INT);
        if($id <= 0) return;
        //echo $id;die;
        $view = Ming_Factory::getView();
        $this->setView('edit');
        $post = Ming_Factory::getRequest()->post('edit', Ming_Filter::TYPE_STRING);
        if( isset($post) &&  $post)
        {
            $this->on_submit('edit');
        }
        $view->assign('data', Users::retrieveByPk($id));
    }

    public function executeAdd() {
        $this->setView('add');
        $post = Ming_Factory::getRequest()->post('add', Ming_Filter::TYPE_STRING);
        $view = Ming_Factory::getView();
        if( isset($post) &&  $post)
        {
            $this->on_submit('add');
        }
    }

    public function executeDelete() {
        $id = Ming_Factory::getRequest()->post('id', Ming_Filter::TYPE_INT);
        if($id <= 0) return;
        $user = new Users();
        $user->id = $id;
        $user->delete();
        Ming_Factory::getRequest()->redirect(Ming_Factory::getDocument()->getPublicPath().'user');
    }

    function on_submit($post)
    {
        $id = Ming_Factory::getRequest()->post('id', Ming_Filter::TYPE_INT);
        $user_name = Ming_Factory::getRequest()->post('user_name', Ming_Filter::TYPE_STRING);
        $password = Ming_Factory::getRequest()->post('password', Ming_Filter::TYPE_STRING);
        $repassword = Ming_Factory::getRequest()->post('repassword', Ming_Filter::TYPE_STRING);
        $full_name = Ming_Factory::getRequest()->post('full_name', Ming_Filter::TYPE_STRING);
        $email = Ming_Factory::getRequest()->post('email', Ming_Filter::TYPE_STRING);
        $phone = Ming_Factory::getRequest()->post('phone', Ming_Filter::TYPE_STRING);
        $mobile = Ming_Factory::getRequest()->post('mobile', Ming_Filter::TYPE_STRING);
        $gender = Ming_Factory::getRequest()->post('gender', Ming_Filter::TYPE_INT);
        $birthday = Ming_Factory::getRequest()->post('birthday', Ming_Filter::TYPE_STRING);
        $address = Ming_Factory::getRequest()->post('address', Ming_Filter::TYPE_STRING);
        $view = Ming_Factory::getView();
        //check ....
        $valid = true;

        $mess =  '';
        $data_mess = array();
        if(!$user_name)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Tên đăng nhập không được để trống!';
        }

        if(!$password)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Mật khẩu không được để trống!';
        }

        if(!$repassword)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Nhập lại mật khẩu không được để trống!';
        }

        if(!$full_name)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Họ tên không được để trống!';
        }

        if(!$email)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Email không được để trống!';
        }

        if(!$phone)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Điện thoại không được để trống!';
        }

        if($password != $repassword)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Hai mật khẩu phải nhập giống nhau!';
        }

        if($mess)
        {
            $view->assign('mess',$mess);
            $view->assign('data_mess',$data_mess);
        }
        else
        {
            //secret
            $secret = UserPeer::genSecret($password);//md5($password. (uniqid(time(),true)));
            $uk = UserPeer::genUk($user_name);//date('my', time()). hash('crc32b' , uniqid(mt_rand(), true).$user_name);
            $user = new Users();

            $user->setUsername($user_name);
            $salt = $user->generateSalt($user_name);// sha1($user_name .uniqid(time(), true));
            $user->setPassword($salt .md5($salt .$password));

            $user->setFullName($full_name);
            $user->setEmail($email);
            $user->setPhone($phone);
            $user->setMobile($mobile);
            $user->setGender($gender);
            $user->setBirthday(str_replace('/','-',$birthday));
            //$user->setAddress($address);
            $user->setSecret($secret);
            $user->setUk($uk);
            //print_r($user);die;
            $is_new = ($post = 'add') ? true: false;
            $user->setNew($is_new);
            if($user->save() == 1)
            {
                Ming_Factory::getRequest()->redirect(Ming_Factory::getDocument()->getPublicPath().'user');
            }
        }
    }

    function on_submit_edit($id)
    {
        $view = Ming_Factory::getView();
        $user_name = Ming_Factory::getRequest()->post('user_name', Ming_Filter::TYPE_STRING);
        $password = Ming_Factory::getRequest()->post('password', Ming_Filter::TYPE_STRING);
        $repassword = Ming_Factory::getRequest()->post('repassword', Ming_Filter::TYPE_STRING);
        $full_name = Ming_Factory::getRequest()->post('full_name', Ming_Filter::TYPE_STRING);
        $email = Ming_Factory::getRequest()->post('email', Ming_Filter::TYPE_STRING);
        $phone = Ming_Factory::getRequest()->post('phone', Ming_Filter::TYPE_STRING);
        $mobile = Ming_Factory::getRequest()->post('mobile', Ming_Filter::TYPE_STRING);
        $gender = Ming_Factory::getRequest()->post('gender', Ming_Filter::TYPE_INT);
        $birthday = Ming_Factory::getRequest()->post('birthday', Ming_Filter::TYPE_STRING);
        //$address = Ming_Factory::getRequest()->post('address', Ming_Filter::TYPE_STRING);

        //check ....
        $valid = true;
        $mess =  '';
        $data_mess = array();
        if(!$user_name)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Tên đăng nhập không được để trống!';
        }

        if(!$password)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Mật khẩu không được để trống!';
        }

        if(!$repassword)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Nhập lại mật khẩu không được để trống!';
        }

        if(!$full_name)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Họ tên không được để trống!';
        }

        if(!$email)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Email không được để trống!';
        }

        if(!$phone)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Điện thoại không được để trống!';
        }

        if($password != $repassword)
        {
            $mess = 'FAILURE';
            $data_mess[] = 'Hai mật khẩu phải nhập giống nhau!';
        }

        if($mess)
        {
            $view->assign('mess',$mess);
            $view->assign('data_mess',$data_mess);
        }
        else
        {
            //secret
            $secret = md5($password. (uniqid(time(),true)));
            $uk = date('my', time()). hash('crc32b' , uniqid(mt_rand(), true).$user_name);
            $user = new Users();

            $user->setUsername($user_name);
            $salt = $user->generateSalt($user_name);// sha1($user_name .uniqid(time(), true));
            $user->setPassword($salt .md5($salt .$password));
            $user->setFullName($full_name);
            $user->setEmail($email);
            $user->setPhone($phone);
            $user->setMobile($mobile);
            $user->setGender($gender);
            $user->setBirthday(str_replace('/','-',$birthday));
            //$user->setAddress($address);
            $user->setSecret($secret);
            $user->setUk($uk);
            //print_r($user);die;
            $user->setNew(false);
            if($user->save() == 1)
            {
                Ming_Factory::getRequest()->redirect(Ming_Factory::getDocument()->getPublicPath().'user');
            }
        }
    }
}