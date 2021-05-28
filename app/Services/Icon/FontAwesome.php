<?php

namespace App\Services\Icon;

use App\Models\Icon;

class FontAwesome
{
    public static function all() : array
    {
        return self::fetchIcons();
    }

    /**
     * Deterrmine whether a given string
     * or array is a fontawesome class
     *
     * @param string|array $icon
     * @return boolean
     */
    public static function classExists($icon) : bool
    {
        return in_array($icon, collect(self::all())->pluck('class')->toArray());
    }


    /**
     * Deterrmine whether a given string
     * or array is a fontawesome class
     *
     * @param string|array $icon
     * @return boolean
     */
    public static function wantsFontAwesome($icon) : bool
    {
        return str_contains($icon, ' fa-') && !str_contains($icon, ' class');
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
