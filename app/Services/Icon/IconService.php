<?php

namespace App\Services\Icon;

use App\Exceptions\GeneralException;
use App\Icons\Models\Icon;
use App\Services\BaseService;
use App\Support\Concerns\GetsIconId;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class PermissionService.
 */
class IconService extends BaseService
{
    use GetsIconId;
    /**
     * PermissionService constructor.
     *
     * @param  Menu  $menu
     */
    public function __construct(Icon $icon)
    {
        $this->model = $icon;
    }

    public function createFromInput(array $data = []): Icon
    {
        $data = $this->filterData($data);

        $input = $data['icon_id'] ?? null;

        $meta = $data['name'] ?? null;

        DB::beginTransaction();

        try {
            $icon = $this->model->find($this->getIconId($input, $meta));
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem creating the icon.'));
        }

        DB::commit();

        return $icon;
    }
}
