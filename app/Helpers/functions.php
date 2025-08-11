<?php 

use App\Models\General_Setting;
use App\Models\Smtp;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


function App_Name()
{
    $setting = General_Setting::get();
    $data = [];
    foreach ($setting as $value) {
        $data[$value->key] = $value->value;
    }
    $app_name = $data['app_name'];

    if (isset($app_name) && $app_name != "") {
        return $app_name;
    } else {
        return env('APP_NAME');
    }
}
function setting_app_name()
{
    $setting = \App\Models\General_Setting::get();
    $data = [];
    foreach ($setting as $value) {
        $data[$value->key] = $value->value;
    }
    return $data['app_name'];
}
function question_limit()
{
    $setting = \App\Models\General_Setting::get();
    $data = [];
    foreach ($setting as $value) {
        $data[$value->key] = $value->value;
    }
    return $data['question_limit'];
}
function smtpData()
{
    $setting = Smtp::first();

    if (isset($setting) && $setting != null) {
        return $setting;
    }
    return false;
}
function tab_icon()
{
    $settingData = settingData();
    $name = $settingData['app_logo'];
    $folder = "app";

    if ($name != "" && $folder != "") {

        $appName = Config::get('app.image_url');

        if (Storage::disk('public')->exists($folder . '/' . $name)) {
            $data = $appName . $folder . '/' . $name;
        } else {
            $data = asset('assets/imgs/no_img.png');
        }
    } else {
        $data = asset('/assets/imgs/no_img.png');
    }
    return ($data);
}
function adminData()
{
    return $emails = Admin::select('user_name', 'email')->first();
}
function settingData()
{
    $setting = General_Setting::get();
    $data = [];
    foreach ($setting as $value) {
        $data[$value->key] = $value->value;
    }
    return $data;
}
function Check_Admin_Access()
{
    if (Auth::guard('admin')->user()->type != 1) {
        return 0;
    } else {
        return 1;
    }
}
function currency_code()
{
    $setting = General_Setting::get();
    $data = [];
    foreach ($setting as $value) {
        $data[$value->key] = $value->value;
    }
    return $data['currency_code'];
}
function string_cut($string, $len)
{
    if (strlen($string) > $len) {
        $string = mb_substr(strip_tags($string), 0, $len, 'utf-8') . '...';
        // $string = substr(strip_tags($string),0,$len).'...';
    }
    return $string;
}
function no_format($num)
{
    if ($num > 1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }
    return $num;
}
function TimeToMilliseconds($str)
{

    $time = explode(":", $str);

    $hour = (int) $time[0] * 60 * 60 * 1000;
    $minute = (int) $time[1] * 60 * 1000;
    $sec = (int) $time[2] * 1000;
    $result = $hour + $minute + $sec;
    return $result;
}
function MillisecondsToTime($str)
{
    $Seconds = (int) $str / 1000;
    $Seconds = round($Seconds);

    $Format = sprintf('%02d:%02d:%02d', ((int) $Seconds / 3600), ((int) $Seconds / 60 % 60), ((int) $Seconds) % 60);
    return $Format;
}





