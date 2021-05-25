<?php

namespace App\Services\Icon;

use App\Models\Icon;

class FontAwesome
{
    public static function all() : array
    {
        return self::fetchIcons();
    }

    private static function fetchIcons()
    {
        $fontAwesomeIcons = [];

        $content = file_get_contents(config('fontawesome.base_url').'/'. config('fontawesome.version').'/'. config('fontawesome.path'));
        $json = json_decode($content);

        foreach ($json as $icon => $value) {
            foreach ($value->styles as $style) {
                $fontAwesomeIcons[] = new Icon([
                    'class' => 'fa' . substr($style, 0, 1) . ' fa-' . $icon,
                    'source' => 'FontAwesome',
                    'version' => 5,
                ]);
            }
        }
        return $fontAwesomeIcons;
    }
}
