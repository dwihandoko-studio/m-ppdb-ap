<?php

namespace App\Controllers;

use App\Libraries\Profilelib;
use App\Libraries\Maintenancelib;
use Firebase\JWT\JWT;

class Dashboard extends BaseController
{
    public function index()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $maintenanceLib = new Maintenancelib();

                    $response = $maintenanceLib->cekMaintenance();

                    if ($response > 0) {
                        if ($role == 1 || ($role == 3 && ($userId == '651f62fc-0d44-4cb1-b460-fc2c418851cf' || $userId == 'eccc941d-c49e-484d-af93-ee64cad00720'))) {
                        } else {
                            return redirect()->to(base_url('maintenance'));
                        }
                    } else {
                        if ($role === 6) {
                            return redirect()->to(base_url('peserta/home'));
                        } else if ($role === 4) {
                            return redirect()->to(base_url('sekolah/home'));
                        } else if ($role === 3) {
                            return redirect()->to(base_url('dinas/home'));
                        } else {
                            return redirect()->to(base_url('web/home'));
                        }
                    }
                } else {
                    delete_cookie('jwt');
                    session()->destroy();
                    return redirect()->to(base_url('web/home'));
                }
            } catch (\Exception $e) {
                delete_cookie('jwt');
                session()->destroy();
                return redirect()->to(base_url('web/home'));
            }
        } else {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
    }
}

        // $jwt = get_cookie('jwt');
        // $token_jwt = getenv('token_jwt.default.key');
        // if ($jwt) {

        //     try {

        //         $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
        //         if ($decoded) {
        //             $userId = $decoded->data->id;
        //             $role = $decoded->data->role;
                    
        //         } else {
        //             return redirect()->to(base_url('web/home'));
        //         }
        //     } catch (\Exception $e) {
        //         return redirect()->to(base_url('web/home'));
        //     }
        // } else {
        //     return redirect()->to(base_url('web/home'));
        // }