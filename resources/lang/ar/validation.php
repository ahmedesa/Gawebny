<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'alpha_dash'           => 'ي    هذا الحقل يجب ان يحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية فقط' ,
    'email'                => ' هذا الحقل يجب ان يحتوي علي عنوان بريد الكتروني',
    'exists'               => 'خذا الحقل غير صالح',
    'image'                => 'هذا الحقل يجب ان يكون صورة',
    'integer'              => 'هذا الحقل يجب ان يكون عدد صحيح',
    'max'                  => [
        'numeric' => 'االحقل :attribute يجب ان يكون علي الاكثر:max رقم',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'الحقل :attribute يجب ان يكون علي الاكثر:max حرف',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'الحقل :attribute يجب ان يكون علي الاقل :min رقم',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'الحقل :attribute يجب ان يكون علي الاقل :min حرف',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'size'                 => [
        'numeric' => 'الحقل :attribute يجب ان يكون حجمة :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'هذا الحقل يجب ان يكون نصي',
    'url'                  => 'هذا الحقل غير صالح',
    'confirmed'            => 'الرقم السري يجب ان يكون متطابق',
    'captcha' =>'يجب تجاوز الCAPATCHA'

];
