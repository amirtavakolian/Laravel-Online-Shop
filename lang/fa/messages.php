<?php

return [
    'auth' => [
        'enterance_code_is_sent' => 'کد ورود برای شما ارسال شد',
        'your_login_code' => 'کد ورود به سایت :code',
        'otp_is_currently_generated' => 'کد ورود قبلا برای شما ارسال شده است',
        'your_enterance_code_is_expired' => 'کد وارد شده منقضی شده است. لطفا مجددا وارد شوید',
        'otp_code_is_wrong' => 'کد وارد شده اشتباه است',
        'password_has_been_set' => 'پسورد شما با موفقیت آپدیت شد',
        'your_account_is_locked_please_contact_with_support' => 'اکانت شما قفل شده است لطفا با پشتیبانی تماس بگیرید',
        'account_not_found' => 'اکانت شما یافت نشد لطفا ابتدا ثبت نام نمایید',
        'user_or_password_is_wrong' => 'شماره موبایل یا پسورد وارد شده اشتباه است',
        'account_lock_because_of_to_many_wrong_password' => 'اکانت شما به دلیل وارد کردن پسورد اشتباه به دفعات بالا قفل شد لطفا با پشتیبانی تماس بگیرید',
        'you_have_registred_succesfully' => 'ثبت نام شما با موفقیت انجام شد',
        'email_has_been_verified' => 'ایمیل شما با موفقیت تایید شد',
        'verification_link_has_sent' => 'لینک تایید ایمیل ارسال شد',
        'forget_password_code_has_sent' => 'کد فراموشی رمز عبور برای شما ارسال شد. لطفا ایمیل خود را چک کنید',
        'email_not_exist' => 'ایمیل وارد شده موجود نمیباشد',
        'the_requested_code_was_removed_due_to_repeated_errors_please_request_a_new_code' => 'کد درخواستی شما به دلیل خطاهای مکرر حذف شد. لطفاً کد جدید درخواست نمایید',
        'your_email_or_code_is_wrong' => 'ایمیل یا کد وارد شده صحیح نمیباشد',
        'your_password_changed_successfully' => 'پسورد شما با موفقیت تغییر کرد',
        'for_using_login_with_link_feature_please_register_with_your_email_first' => 'برای استفاده از قابلیت لاگین با لینک مستقیم؛ لطفا یکبار با ایمیل وارد شده ثبت نام کنید سپس دوباره اقدام نمایید',
        'login_url_is_sent_please_check_your_email' => 'لینک ورود برای شما ارسال شد. لطفا ایمیل خود را چک کنید',
        'email_not_set' => 'ایمیل شما ثبت نشده است',
        'mobile_not_set' => 'شماره موبایل شما ثبت نشده است',
        'your_two_auth_code' => 'رمز دو مرحله ایی شما: :code',
        'two_auth_code_has_been_sent' => 'کد 2 مرحله ایی برای شما ارسال شد',
        'wrong_two_auth_code' => 'کد 2 مرحله ایی وارد شده اشتباه است',
        'coworker_successfully_registered' => 'کارمند مورد نظر با موفقیت ثبت نام شد'
    ],
    'role_perm' => [
        'roles_has_been_created_successfully' => 'رول مورد نظر با موفقیت ساخته شد',
        'roles_has_been_updated_successfully' => 'رول مورد نظر با موفقیت آپدیت شد',
        'roles_has_been_deleted_successfully' => 'رول مورد نظر با موفقیت حذف شد',
        'permissions_has_been_created_successfully' => 'سطح دسترسی مورد نظر با موفقیت ساخته شد',
        'permissions_has_been_updated_successfully' => 'سطح دسترسی مورد نظر با موفقیت آپدیت شد',
        'permissions_has_been_deleted_successfully' => 'سطح دسترسی مورد نظر با موفقیت حذف شد',
        'role_has_been_assigned_successfully' => 'نقش کاربری با موفقیت اهدا شد',
        'user_roles_has_been_removed_successfully' => 'رول کاربر با موفقیت حذف شد',
        'permissions_has_been_assigned_to_role_successfully' => 'سطوح دسترسی با موفقیت به نقش کاربر اضافه شد'
    ],
    'coworkers' => [
        'coworker_added_to_support_department' => 'کارمند مورد نظر به دپارتمان پشتیبانی اضافه شد'
    ],
    'notifications' => [
        'remind_support_team_after_15_minutes' => '15 دقیقه از ایجاد تیکت گذشته است و هنوز توسط تیم پشتیبانی بررسی نشده است. لطفاً در اسرع وقت به آن رسیدگی کنید.',
        'remind_boss_after_15_minutes' => '15 دقیقه از ایجاد تیکت گذشته است و هنوز توسط تیم پشتیبانی بررسی نشده است.'
    ],
    'tickets' => [
        'ticket_created_successfully' => 'تیکت شما با موفقیت ساخته شد',
        'your_answer_submitted_successfully' => 'پاسخ شما با موفقیت ثبت شد',
        'you_cant_assign_the_ticket_which_you_dont_open' => 'نمیتوانید تیکتی که خودتان باز نکردین را ارجاع بدهید',
        'selected_coworker_currently_has_three_opened_tickets' => 'در حال حاضر؛ کارمند انتخاب شده؛ 3 تیکت باز دارد',
        'ticket_succesfully_assigned_to_another_coworker' => 'تیکت با موفقیت به کارمندی دیگری اختصاص داده شد',
        'you_cant_assign_the_ticket_to_coworkers_of_other_departments' => 'شما نمیتوانید این تیکت را به کارمندان پشتیبانی دیگری ارسال کنید',
        'a_new_ticket_has_assigned_to_you' => 'یک تیکت جدید به شما ارجاع داده شد',
        'a_ticket_from_a_coworker_assigned_to_another' => 'یک تیکت از :from_coworker به :to_coworker در بخش :support ارجاع داده شد',
        'you_cant_assign_another_department_ticket' => 'شما نمیتوانید تیکت دپارتمان دیگری را ارجاع دهید',
        'ticket_succesfully_assigned_to_another_department' => 'تیکت با موفقیت به دپارتمان دیگری اختصاص داده شد',
        'ticket_belongs_to_this_department' => 'تیکت مطعلق به همین دپارتمان میباشد',
        'a_ticket_from_a_coworker_assigned_to_another_department' => 'یک تیکت از :from_coworker به دپارتمان :support ارجاع داده شد',
        'ticket_has_updated_successfully' => 'تیکت شما با موفقیت آپدیت شد',
        'ticket_has_deleted_successfully' => 'تیکت شما با موفقیت حذف شد',
        'your_ticket_is_answered' => 'تیکت شما پاسخ داده شد',
        'your_ticket_submited_successfully' => 'تیکت شما با موفقیت ثبت شد',
        'ticket_closed_successfully' => 'تیکت با موفقیت بسته شد',
        'ticket_is_closed' => 'تیکت قبلا بسته شده است'
    ],
    'brands' => [
        'brand_successfully_created' => 'برند با موفقیت ساخته شد',
        'brand_successfully_updated' => 'برند با موفقیت آپدیت شد',
        'brand_successfully_deleted' => 'برند با موفقیت حذف شد'
    ],
    'attributes' => [
        'attribute_successfully_created' => 'ویژگی با موفقیت ساخته شد',
        'attribute_successfully_updated' => 'ویژگی با موفقیت آپدیت شد',
        'attribute_successfully_deleted' => 'ویژگی با موفقیت حذف شد'
    ],
    'categories' => [
        'category_successfully_created' => 'دسته بندی با موفقیت ساخته شد',
        'category_successfully_updated' => 'دسته بندی با موفقیت آپدیت شد',
        'category_successfully_deleted' => 'دسته بندی با موفقیت حذف شد',
    ],
    'tags' => [
        'tag_successfully_created' => 'تگ با موفقیت ساخته شد',
        'tag_successfully_updated' => 'تگ با موفقیت آپدیت شد',
        'tag_successfully_deleted' => 'تگ با موفقیت حذف شد',
    ],
    'products' => [
        'product_successfully_created' => 'محصول با موفقیت ساخته شد',
        'product_successfully_updated' => 'محصول با موفقیت آپدیت شد',
    ],
    'banners' => [
        'banner_successfully_created' => 'بنر با موفقیت ساخته شد'
    ],
];
