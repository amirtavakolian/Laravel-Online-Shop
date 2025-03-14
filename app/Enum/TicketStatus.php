<?php

namespace App\Enum;

enum TicketStatus: string
{
    case AWAITING_SUPPORT_RESPONSE = "در انتظار پاسخ پشتیبان";
    case UNDER_REVIEW = "در حال بررسی";
    case RESPONDED = "پاسخ داده شده";

    case URGENT = 'فوری';
    case IMPORTANT = 'مهم';
    case NORMAL = 'عادی';
}
