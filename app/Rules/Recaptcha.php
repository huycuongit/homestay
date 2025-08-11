<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

use App\Models\System;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $reptchaKey = System::content('google_recaptcha_secret_key') ? System::content('google_recaptcha_secret_key') : '6Ldt3v8pAAAAAMUCAr5r3WSOxa-o1FDv4LQVGR4R';
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $reptchaKey,
            'response' => $value
        ]);

        $result = json_decode($response->body(), true);
        
        // Kiểm tra nếu reCAPTCHA trả về thành công và điểm số đủ cao
        return $result['success'] && $result['score'] >= 0.5;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Xác thực reCAPTCHA thất bại. Vui lòng thử lại.';
    }
}
