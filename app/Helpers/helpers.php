<?php

use Illuminate\Support\Facades\Auth;
use App\Models\shareholderLog;
use App\Models\Admin;
use Carbon\Carbon;

if (!function_exists('checkAuth')) {
    function checkAuth($guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return Auth::guard($guard)->user();
        }
        return null;
    }
}

if (!function_exists('userHasPermission')) {
    function userHasPermission($permission)
    {
        return Auth::user() && Auth::user()->hasPermission($permission);
    }
}

if (!function_exists('userHasAnyPermission')) {
    function userHasAnyPermission($permissions)
    {
        return Auth::user() && Auth::user()->hasAnyPermission($permissions);
    }
}

if (!function_exists('showValue')) {
    function showSetting($arr, $key, $default = '')
    {
        return isset($arr) && isset($arr[$key]) && $arr[$key] ? $arr[$key] : $default;
    }
}

if (!function_exists('encodeString')) {
    function encodeString()
    {
        $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $charactersLength = strlen($characters);
        $desiredLength = 11;

        $encodedString = "";
        for ($i = 0; $i < $desiredLength; $i++) {
            $randomIndex = rand(0, $charactersLength - 1);
            $encodedString .= $characters[$randomIndex];
        }

        return $encodedString;
    }
}

if (!function_exists('getBranches')) {
    function getBranches()
    {
        $user = Auth::user();
        if ($user) {
            return $user->getBranches();
        }
        return [];
    }
}

if (!function_exists('isValidBase64Image')) {
    function isValidBase64Image($string)
    {
        // Biểu thức chính quy để kiểm tra định danh MIME type và phần mã hóa Base64
        $pattern = '/^data:image\/[a-zA-Z0-9]+;base64,/';

        // Kiểm tra xem chuỗi có khớp với định dạng "data:image/<type>;base64," không
        if (!preg_match($pattern, $string)) {
            return false;
        }

        // Loại bỏ phần định danh để lấy phần mã hóa Base64
        $base64String = preg_replace($pattern, '', $string);

        // Kiểm tra xem phần còn lại có phải là một chuỗi Base64 hợp lệ không
        $decoded = base64_decode($base64String, true);

        return $decoded !== false && base64_encode($decoded) === $base64String;
    }
}


if (!function_exists('checkValue')) {
    function checkValue($value, $key, $default = '')
    {
        if (gettype($value) == 'array') {

            return isset($value) &&  isset($value[$key]) && $value[$key] ? $value[$key] : $default;
        } else {

            return isset($value) &&  isset($value->{$key}) && $value->{$key} ? $value->{$key} : $default;
        }
    }
}

if (!function_exists('generateCombinedTimestamp')) {
    function generateCombinedTimestamp($providedDate, $providedTime)
    {
        $dateObject = Carbon::createFromFormat('Y-m-d', $providedDate);

        $timeParts = explode(":", $providedTime);
        $hours = intval($timeParts[0]);
        $minutes = intval($timeParts[1]);
        $seconds = intval($timeParts[2] ?? 0);

        $dateObject->setTime($hours, $minutes, $seconds);

        return $dateObject->timestamp;
    }
}

if (!function_exists('formatShowCoach')) {
    function formatShowCoach($data)
    {
        $str = "";

        if ($data) {
            if ($data->coachType) {
                $coachType = $data->coachType;
                $str .= "{$coachType->name}";
            }

            if ($str) {
                $str .= " - {$data->code} - {$data->name}";
            } else {
                $str .= "{$data->code} - {$data->name}";
            }
        }

        return $str;
    }
}

if (!function_exists('showValueSystem')) {
    function showValueSystem($arr, $key, $default = '')
    {
        return isset($arr) && !empty($arr[$key]['content']) ? $arr[$key]['content'] : old($key);
    }
}

if (!function_exists('logshareholderAction')) {
    function logshareholderAction($shareholder, $actionType)
    {
        $authAdmin = Auth::user();
        if (!Auth::user()) {
            $authAdmin = Admin::where('user_name', 'Admin')->first();
        }

        $logData = [
            'ip' => request() ? request()->ip() : 'Server',
            'device_id' => request() ? request()->header('User-Agent') : 'Bot',
            'type' => $actionType,
            'user_type' => 'Admin',
            'user_id' => $authAdmin->id,
            'shareholder_id' => $shareholder->id,
        ];

        if ($actionType == shareholder_LOG_BURN_SHOW) {
            $logData = array_merge($logData, [
                'is_fined' => 1,
                'student_id' => $shareholder->student_id ? $shareholder->student_id : null
            ]);
        }

        shareholderLog::create($logData);
    }
}

if (!function_exists('formatInputPrice')) {
    function formatInputPrice($input)
    {
        return $input ? (int) str_replace([' ', ','], '', $input) : null;
    }
}
if (!function_exists('formatOutputPrice')) {
    function formatOutputPrice($input)
    {
        return number_format($input, 0, '.', ',');
    }
}


function checkValue($value, $key, $default = '')
{
    if (gettype($value) == 'array') {

        return isset($value) &&  isset($value[$key]) && $value[$key] ? $value[$key] : $default;
    } else {

        return isset($value) &&  isset($value->{$key}) && $value->{$key} ? $value->{$key} : $default;
    }
}

function renderCleanList($html)
{
    return str_replace(['<ul>', '</ul>'], '', $html);
}



if (!function_exists('formatPhone')) {
    function formatPhone($phone)
    {
        $clean = preg_replace('/\D/', '', $phone);

        if (strpos($clean, '84') === 0) {
            $clean = '0' . substr($clean, 2);
        }

        if (strlen($clean) === 10) {
            return substr($clean, 0, 4) . ' ' . substr($clean, 4, 3) . ' ' . substr($clean, 7);
        }

        return $phone;
    }
}
