<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**Add commentMore actions
     * @return bool
     */
    public static function isShowExceptionMessage(): bool
    {
        return (bool)env('SHOW_EXCEPTION_MESSAGE');
    }
}
