<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToggleNas extends Controller
{
    public function handle(){
        $cmd = "python ".base_path()."/switchOn.py";
        exec($cmd, $output, $exitCode);
        if ($exitCode == 1){
            $exitMessage = "Success! Exited with $exitCode, NAS ok";
            exec("mount /dev/sda2 /server_mount/nas");
            return $exitMessage;
        } else {
            $exitMessage = "Error! Exited with $exitCode, contact the SysAdmin";
            return $exitMessage;
        }

        return redirect('/')->with('exit', $exitCode);
    }
    
}
