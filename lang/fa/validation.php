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

    'accepted' => ':attribute باید پذیرفته شود.',
    'accepted_if' => ':attribute باید زمانی که :other برابر :value است، پذیرفته شود.',
    'active_url' => ':attribute یک URL معتبر نیست.',
    'after' => ':attribute باید یک تاریخ پس از :date باشد.',
    'after_or_equal' => ':attribute باید یک تاریخ پس از یا مساوی با :date باشد.',
    'alpha' => ':attribute فقط باید شامل حروف باشد.',
    'alpha_dash' => ':attribute فقط باید شامل حروف، اعداد، خطوط تیره و زیرخط‌ها باشد.',
    'alpha_num' => ':attribute فقط باید شامل حروف و اعداد باشد.',
    'array' => ':attribute باید یک آرایه باشد.',
    'before' => ':attribute باید یک تاریخ قبل از :date باشد.',
    'before_or_equal' => ':attribute باید یک تاریخ قبل از یا مساوی با :date باشد.',
    'between' => [
        'array' => ':attribute باید بین :min و :max مورد باشد.',
        'file' => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'string' => ':attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => 'فیلد :attribute باید صحیح یا غلط باشد.',
    'confirmed' => 'تایید :attribute مطابقت ندارد.',
    'current_password' => 'گذرواژه نادرست است.',
    'date' => ':attribute یک تاریخ معتبر نیست.',
    'date_equals' => ':attribute باید برابر با تاریخ :date باشد.',
    'date_format' => ':attribute با فرمت :format مطابقت ندارد.',
    'declined' => ':attribute باید رد شود.',
    'declined_if' => ':attribute باید زمانی که :other برابر :value است، رد شود.',
    'different' => ':attribute و :other باید متفاوت باشند.',
    'digits' => ':attribute باید :digits رقم باشد.',
    'digits_between' => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions' => ':attribute ابعاد تصویر نامعتبر دارد.',
    'distinct' => 'فیلد :attribute دارای مقدار تکراری است.',
    'doesnt_end_with' => ':attribute نباید با یکی از موارد زیر پایان یابد: :values.',
    'doesnt_start_with' => ':attribute نباید با یکی از موارد زیر شروع شود: :values.',
    'email' => ':attribute باید یک آدرس ایمیل معتبر باشد.',
    'ends_with' => ':attribute باید با یکی از موارد زیر پایان یابد: :values.',
    'enum' => ':attribute انتخاب شده نامعتبر است.',
    'exists' => ':attribute انتخاب شده نامعتبر است.',
    'file' => ':attribute باید یک فایل باشد.',
    'filled' => 'فیلد :attribute باید دارای مقدار باشد.',
    'gt' => [
        'array' => ':attribute باید بیشتر از :value مورد باشد.',
        'file' => ':attribute باید بیشتر از :value کیلوبایت باشد.',
        'numeric' => ':attribute باید بیشتر از :value باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => ':attribute باید حداقل :value مورد باشد.',
        'file' => ':attribute باید حداقل :value کیلوبایت باشد.',
        'numeric' => ':attribute باید حداقل :value باشد.',
        'string' => ':attribute باید حداقل :value کاراکتر باشد.',
    ],
    'image' => ':attribute باید یک تصویر باشد.',
    'in' => ':attribute انتخاب شده نامعتبر است.',
    'in_array' => 'فیلد :attribute در :other وجود ندارد.',
    'integer' => ':attribute باید یک عدد صحیح باشد.',
    'ip' => ':attribute باید یک آدرس IP معتبر باشد.',
    'ipv4' => ':attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6' => ':attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => ':attribute باید یک رشته JSON معتبر باشد.',
    'lowercase' => ':attribute باید حروف کوچک باشد.',
    'lt' => [
        'array' => ':attribute باید کمتر از :value مورد باشد.',
        'file' => ':attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => ':attribute باید کمتر از :value باشد.',
        'string' => ':attribute باید کمتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => ':attribute نباید بیشتر از :value مورد باشد.',
        'file' => ':attribute باید حداکثر :value کیلوبایت باشد.',
        'numeric' => ':attribute باید حداکثر :value باشد.',
        'string' => ':attribute باید حداکثر :value کاراکتر باشد.',
    ],
    'mac_address' => ':attribute باید یک آدرس MAC معتبر باشد.',
    'max' => [
        'array' => ':attribute نباید بیشتر از :max مورد باشد.',
        'file' => ':attribute نباید بیشتر از :max کیلوبایت باشد.',
        'numeric' => ':attribute نباید بیشتر از :max باشد.',
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
    ],
    'max_digits' => ':attribute نباید بیشتر از :max رقم باشد.',
    'mimes' => ':attribute باید یک فایل از نوع :values باشد.',
    'mimetypes' => ':attribute باید یک فایل از نوع :values باشد.',
    'min' => [
        'array' => ':attribute باید حداقل :min مورد باشد.',
        'file' => ':attribute باید حداقل :min کیلوبایت باشد.',
        'numeric' => ':attribute باید حداقل :min باشد.',
        'string' => ':attribute باید حداقل :min کاراکتر باشد.',
    ],
    'min_digits' => ':attribute باید حداقل :min رقم باشد.',
    'multiple_of' => ':attribute باید یک ضریب از :value باشد.',
    'not_in' => ':attribute انتخاب شده نامعتبر است.',
    'not_regex' => 'فرمت :attribute نامعتبر است.',
    'numeric' => ':attribute باید یک عدد باشد.',
    'password' => [
        'letters' => ':attribute باید حاوی حداقل یک حرف باشد.',
        'mixed' => ':attribute باید حاوی حداقل یک حرف بزرگ و یک حرف کوچک باشد.',
        'numbers' => ':attribute باید حاوی حداقل یک عدد باشد.',
        'symbols' => ':attribute باید حاوی حداقل یک نماد باشد.',
        'uncompromised' => ':attribute داده‌های تسریب شده راحت دارد. لطفاً یک :attribute دیگر انتخاب کنید.',
    ],
    'present' => 'فیلد :attribute باید حاضر باشد.',
    'prohibited' => 'فیلد :attribute ممنوع است.',
    'prohibited_if' => 'فیلد :attribute زمانی که :other برابر :value است، ممنوع است.',
    'prohibited_unless' => 'فیلد :attribute مگر اینکه :other در :values باشد، ممنوع است.',
    'prohibits' => 'فیلد :attribute ممنوع می‌کند :other از حاضر بودن.',
    'regex' => 'فرمت :attribute نامعتبر است.',
    'required' => 'فیلد :attribute الزامی است.',
    'required_array_keys' => 'فیلد :attribute باید ورودی‌هایی برای :values داشته باشد.',
    'required_if' => 'فیلد :attribute زمانی که :other برابر :value است، الزامی است.',
    'required_if_accepted' => 'فیلد :attribute زمانی که :other پذیرفته شده است، الزامی است.',
    'required_unless' => 'فیلد :attribute مگر اینکه :other در :values باشد، الزامی است.',
    'required_with' => 'فیلد :attribute زمانی که :values حاضر است، الزامی است.',
    'required_with_all' => 'فیلد :attribute زمانی که همه :values حاضر هستند، الزامی است.',
    'required_without' => 'فیلد :attribute زمانی که :values حاضر نیست، الزامی است.',
    'required_without_all' => 'فیلد :attribute زمانی که هیچ‌کدام از :values حاضر نیستند، الزامی است.',
    'same' => ':attribute و :other باید مطابقت داشته باشند.',
    'size' => [
        'array' => ':attribute باید شامل :size مورد باشد.',
        'file' => ':attribute باید :size کیلوبایت باشد.',
        'numeric' => ':attribute باید :size باشد.',
        'string' => ':attribute باید :size کاراکتر باشد.',
    ],
    'starts_with' => ':attribute باید با یکی از موارد زیر شروع شود: :values.',
    'string' => ':attribute باید یک رشته باشد.',
    'timezone' => ':attribute باید یک منطقه زمانی معتبر باشد.',
    'unique' => ':attribute قبلاً استفاده شده است.',
    'uploaded' => ':attribute بارگذاری نشد.',
    'uppercase' => ':attribute باید حروف بزرگ باشد.',
    'url' => ':attribute باید یک URL معتبر باشد.',
    'uuid' => ':attribute باید یک UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'mobile' => 'شماره موبایل',
        'users.*.mobile' => 'شماره موبایل کاربر :position',
        'users.*.first_name' => 'نام کاربر :position',
        'users.*.last_name' => 'نام خانوادگی کاربر :position',
        'users.*.job_position' => 'موقعیت شغلی کاربر :position',
        'users.*.email' => 'ایمیل کاربر :position',
        'users.*.birthday' => 'تاریخ تولد کاربر :position',
        'users.*.date_of_employment' => 'تاریخ استخدام کاربر :position',
        'coin_value' => 'نرخ سکه'
    ],


    'values' => [
        'expiration_date' => [
            'today' => 'امروز'
        ]
    ]
];
