<?php

namespace App\Support\Concerns;

trait InteractsWithBanner
{
    /**
     * Update the banner message.
     *
     * @param  string  $message
     * @return void
     */
    protected function banner($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => $message,
        ]);
    }

    /**
     * Update the banner message with an danger / error message.
     *
     * @param  string  $message
     * @return void
     */
    protected function dangerBanner($message)
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'danger',
            'message' => $message,
        ]);
    }

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
