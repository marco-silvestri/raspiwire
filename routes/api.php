<?php

use App\Models\Gpio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/switchOn', function () {
    $out = "";
    $toggleExit = "";
    $name = request()->input('name');
    $pin = Gpio::where('name', $name)->first();

    exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js {$pin->gpioNumber} 1", $out, $toggleExit);
    do {
        exec("sudo -S mount UUID=\"{$pin->hd_uuid}\" {$pin->mount_destination}", $out, $exitCode);
        sleep(10);
    } while ($exitCode != 0);
    if ($exitCode == 0) {
        $this->pin->update(['state' => 1]);
    }
});

Route::get('/switchOff', function () {
    $out = "";
    $exitCode = "";
    $name = request()->input('name');
    $pin = Gpio::where('name', $name)->first();

    exec("sudo -S umount -f -l {$pin->mount_destination}", $out, $exitCode);
    if ($exitCode != 0) {
        Log::error($out);
    } else {
        $pin->update(['state' => 0]);
        exec("sudo -S node /home/pi/www/raspiwire/resources/js/toggle.js {$pin->gpioNumber} 0", $out, $err);
        Log::info($out);
    }
});


