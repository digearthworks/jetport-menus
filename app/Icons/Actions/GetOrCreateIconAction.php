<?php

namespace App\Icons\Actions;

use App\Icons\Models\Icon;
use App\Support\FontAwesome;
use Illuminate\Support\Str;

class GetOrCreateIconAction
{
    /**
     * Return first icon matching input
     * by class, html, or id. Never
     * empty. Returns default icon
     * in null case, creates icon
     * if there is no match
     *
     * @param mixed $icon
     * @return integer
     */
    public function __invoke($icon, $meta = null) : Icon
    {
        // Leave early if there is no icon
        if (!$icon) {
            return Icon::first();
        }
        if ($meta) {
            $meta = Str::snake($meta);
        }

        $fontAwesome = FontAwesome::wantsFontAwesome($icon);

        if (is_int($icon)) {
            return Icon::query()->find($icon) ? Icon::query()->find($icon) : null;
        }

        $id = (!$fontAwesome) ? Icon::query()->where('html', $icon)->value('id') : Icon::query()->where('class', $icon)->value('id');

        if ($id) {
            if ($meta) {
                $iconFromId = Icon::find($id);
                $iconFromId->meta  =  $iconFromId->meta ? $iconFromId->meta . ' ' . $meta : $meta;
                $iconFromId->save();
            }
            return $iconFromId;
        }

        $iconAttributes = (!$fontAwesome) ? [
                'html' => $icon,
                'source' => 'raw',
                'meta' => $meta,
            ] : [
                'class' => $icon,
                'source' => 'FontAwesome',
                'version' => config('fontawesome.version'),
                'meta' => $meta,
            ];

        $icon = Icon::create($iconAttributes);

        return $icon;
    }
}