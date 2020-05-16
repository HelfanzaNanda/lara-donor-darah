<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class APIController extends Controller
{
    public function simpanRegister(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'phone'      => "08923423455",
            'role'       => 'pendonor',
            'password'   => bcrypt($request->password)
        ]);

        if($user){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }

    }
}
