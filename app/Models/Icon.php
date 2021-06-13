<?php

namespace App\Models;

use App\Models\Concerns\Attribute\IconAttribute;
use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Scope\IconScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Icon extends Model
{
    use AuthConnection,
        HasFactory,
        HasUuid,
        IconAttribute,
        IconScope,
        Userstamps;

    protected $guarded = [];

    protected $appends = ['art', 'input'];

    public function menus(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menu::class);
    }

    private function repairWithoutTidy(string $html): string
    {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

    private function repairHtml(string $html)
    {
        if (class_exists('tidy')) {
            return (new \tidy())->repairString($html, [
                'output-xml' => true,
                'input-xml' => true,
            ]);
        }

        return $this->repairWithoutTidy($html);
    }
}
