<?php

if (! function_exists('toEnglishDigits')) {
    /**
     * تبدیل اعداد فارسی و عربی به اعداد انگلیسی.
     */
    function toEnglishDigits(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return strtr($value, [
            '۰' => '0',
            '۱' => '1',
            '۲' => '2',
            '۳' => '3',
            '۴' => '4',
            '۵' => '5',
            '۶' => '6',
            '۷' => '7',
            '۸' => '8',
            '۹' => '9',

            '٠' => '0',
            '١' => '1',
            '٢' => '2',
            '٣' => '3',
            '٤' => '4',
            '٥' => '5',
            '٦' => '6',
            '٧' => '7',
            '٨' => '8',
            '٩' => '9',
        ]);
    }
}

if (! function_exists('toPersianDigits')) {
    /**
     * تبدیل اعداد انگلیسی و عربی به اعداد فارسی.
     */
    function toPersianDigits(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return strtr($value, [
            '0' => '۰',
            '1' => '۱',
            '2' => '۲',
            '3' => '۳',
            '4' => '۴',
            '5' => '۵',
            '6' => '۶',
            '7' => '۷',
            '8' => '۸',
            '9' => '۹',

            '٠' => '۰',
            '١' => '۱',
            '٢' => '۲',
            '٣' => '۳',
            '٤' => '۴',
            '٥' => '۵',
            '٦' => '۶',
            '٧' => '۷',
            '٨' => '۸',
            '٩' => '۹',
        ]);
    }
}

if (! function_exists('faNumber')) {
    /**
     * نمایش عدد با ارقام فارسی.
     */
    function faNumber(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        return toPersianDigits((string) $value);
    }
}