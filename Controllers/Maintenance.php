<?php 

namespace App\Controllers;

use App\Libraries\Maintenancelib;

class Maintenance extends BaseController
{
	public function index()
	{
	    $maintenanceLib = new Maintenancelib();
            
        $response = $maintenanceLib->cekMaintenance();
        
        if($response > 0) {
            // var_dump("HEELLO");die;
            return view('maintenance');
        } else {
            return redirect()->to(base_url('auth'));
            
        }
        
		
	}
	
	public function test()
	{
	    $maintenanceLib = new Maintenancelib();
            
        $response = $maintenanceLib->cekMaintenance();
        
        if($response > 0) {
            // var_dump("HEELLO");die;
            return view('maintenance');
        } else {
            return redirect()->to(base_url('auth'));
            
        }
        
		
	}

}
