<?php

namespace App\Http\Livewire\Admin\Icon;

use App\Models\Icon;
use Livewire\Component;

class IconSelect extends Component
{

    public $query;
    public $icons;
    public $iconSource;
    public $source;

    public function mount($source = null)
    {

        $icons = [];

        switch ($source) {
            case 'FontAwesome':

                $content = file_get_contents('https://raw.githubusercontent.com/FortAwesome/Font-Awesome/5.15.3/metadata/icons.json');
                $json = json_decode($content);

                foreach ($json as $icon => $value) {
                    foreach ($value->styles as $style) {
                        $icons[] = new Icon([
                            'class' => 'fa' . substr($style, 0, 1) . ' fa-' . $icon,
                            'source' => 'FontAwesome',
                            'version' => 5,
                        ]);
                    }
                }
                break;

            default:
                $icons = Icon::all();
                break;
        }

        $this->iconSource = collect($icons);
        $this->icons = $this->iconSource;
    }

    public function updatedQuery()
    {
        $query = $this->query;

        $this->icons = $this->iconSource->filter(function ($icon, $key) use ($query) {
            return str_contains($icon['class'] ?? '', $query) ||
                str_contains($icon['html'] ?? '', $query) ||
                str_contains($icon['meta'] ?? '', $query) ||
                str_contains($icon['source'] ?? '', $query);
        });
    }

    public function render()
    {
        return view('admin.icons.icon-select');
    }
}
