<?php

namespace App\Controllers;

use App\Libraries\Authlib;
use App\Libraries\Capillib;

class Message extends BaseController
{
    public function index()
    {
        $friends = $this->request->getGet('friends');
        
        $capilLib = new Capillib();
        $data['user'] = $capilLib->profileUser();
        $data['messages'] = $capilLib->messagesUser();
        // var_dump($friends);die;
        if($friends == null) {
            
            if(count($data['messages']->result) > 0) {
                $url = $data['messages']->result[0]->senderId;
                // var_dump($url);die;
                return redirect()->to(base_url('message?friends='.$url));
            } else {
                $data['page'] = "Pesan";
                $data['file_upload'] = FALSE;
                $data['title'] = 'Pesan';
                $data['datatables'] = false;
                
                echo view('message/head', $data);
                echo view('template/topbar', $data);
                echo view('template/left-sidebar', $data);
                echo view('template/right-sidebar', $data);
                // $this->load->view('template/pageslide-right', $data);
                echo view('message/index', $data);
                echo view('template/core');
                echo view('message/core');
                echo view('template/footer');
            }
        } else {
            $friend = htmlspecialchars($friends, true);
            $data['page'] = "Pesan";
            $data['file_upload'] = FALSE;
            $data['title'] = 'Pesan';
            $data['datatables'] = false;
            $neededObject = current(array_filter($data['messages']->result, function($e) use($friend) { return $e->senderId==$friend; }));
            $data['friend'] = $neededObject;
            
            var_dump($neededObject);die;
            
            $data['messageChatFriend'] = $capilLib->messagesChatUser($friend);
            
            echo view('message/head', $data);
            echo view('template/topbar', $data);
            echo view('template/left-sidebar', $data);
            echo view('template/right-sidebar', $data);
            // $this->load->view('template/pageslide-right', $data);
            echo view('message/index', $data);
            echo view('template/core');
            echo view('message/core');
            echo view('template/footer');
        }
    }
}
