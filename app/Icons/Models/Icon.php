<?php

namespace App\Icons\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Icons\Concerns\IconAttribute;
use App\Icons\QueryBuilders\IconQueryBuilder;
use App\Support\Concerns\HasUuid;
use Database\Factories\IconFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wildside\Userstamps\Userstamps;

class Icon extends Model
{
    use GetsAuthConnection,
        HasFactory,
        HasUuid,
        IconAttribute,
        Userstamps;

    protected $guarded = [];

    protected $appends = ['art', 'input'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return IconFactory::new();
    }


    public function newEloquentBuilder($query): IconQueryBuilder
    {
        return new IconQueryBuilder($query);
    }

    public function menus(): HasMany
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
