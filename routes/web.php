<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


class Platform
{
    private $platform;

    public function __construct($platform)
    {
        $this->platform = $platform;
    }

    public function platform()
    {
        return $this->platform;
    }
}

Route::get('/test', '\App\Controllers\Upsells@test');

Route::get('/', function () {
    return view('welcome');
});
