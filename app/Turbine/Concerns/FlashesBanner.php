<?php

namespace App\Turbine\Concerns;

trait FlashesBanner
{
    protected function flashBanner($message)
    {
        session()->flash('falsh.bannerStyle', 'success');
        session()->flash('flash.banner', $message);
    }

    protected function flashDangerBanner($message)
    {
        session()->flash('falsh.bannerStyle', 'danger');
        session()->flash('flash.banner', $message);
    }
}
