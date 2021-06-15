<?php

namespace App\Support;

class TidyHtml
{
    public string $html;

    public function __construct(string $html)
    {
        $this->html = $this->repairHtml($html);
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
    }

    private function repairHtml(string $html) : string
    {
        if (extension_loaded('tidy')) {
            return (new \tidy())->repairString($html, [
                'output-xml' => true,
                'input-xml' => true,
            ]);
        }

        return $this->repairWithoutTidy($html);
    }
}
