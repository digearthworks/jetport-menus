<?php

namespace App\Turbine\Pages\Http\Livewire;

use App\Turbine\Pages\Models\PageTemplate;

trait SwapsTemplate
{
    public function swapTemplate($id = null)
    {
        $template = PageTemplate::find($id);

        if (! $template) {
            return;
        }

        $html = $template->html;
        $css = $template->css;
        $this->state['html'] = $html;
        $this->state['css'] = $css;
        $this->emit('swap-template', json_encode([
            'html' => $html,
            'css' => $css,
        ], JSON_FORCE_OBJECT));
    }
}
