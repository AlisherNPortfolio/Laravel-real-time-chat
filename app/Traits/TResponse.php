<?php

namespace App\Traits;

trait TResponse
{
    public function redirectBack(string $type = null, string $message = null)
    {
        $back = redirect()->back();

        return $type && $message ? $back->with($type, $message) : $back;
    }

    public function redirectToView(string $view, string $type = null, string $message = null)
    {
        $redirect = redirect()->route($view);
        if ($type && $message) {
            $redirect = $redirect->with($type, $message);
        }

        return $redirect;
    }

    public function redirectBackError(string $type = null, string $message = null)
    {
        $back = back();

        return $type && $message ? $back->withErrors([$type => $message]) : $back;
    }
}
