<?php

namespace App\Support;

use App\Facades\Blink;
use App\Icons\Models\Icon;
use Illuminate\Support\Facades\Http;

class FontAwesome
{
    public static function all() : array
    {
        return Blink::once(now()->format('y-m-d'), fn () => self::fetchIcons());
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

    /**
     * @return Icon[]
     *
     * @psalm-return list<Icon>
     */
    private static function fetchIcons(): array
    {
        $fontAwesomeIcons = [];

        $content = Http::get(config('fontawesome.base_url').'/'. config('fontawesome.version').'/'. config('fontawesome.path'))->body();
        $json = json_decode($content);

        foreach ($json as $icon => $value) {
            foreach ($value->styles as $style) {
                $fontAwesomeIcons[] = new Icon([
                    'class' => 'fa' . substr($style, 0, 1) . ' fa-' . $icon,
                    'source' => 'FontAwesome',
                    'version' => config('fontawesome.version'),
                ]);
            }
        }
        return $fontAwesomeIcons;
    }
}
