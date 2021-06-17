<?php

namespace App\Icons\Actions;

use App\Exceptions\GeneralException;
use App\Icons\Models\Icon;
use App\Support\Concerns\FiltersData;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;

class GetIconFromInputAction
{
    use FiltersData;

    public GetOrCreateIconAction $getOrCreateIconAction;

    public function __construct(
        GetOrCreateIconAction $getOrCreateIconAction
    ) {
        $this->getOrCreateIconAction = $getOrCreateIconAction;
    }

    public function __invoke($data) : Icon
    {
        $data = $this->filterData($data);

        $input = $data['icon_id'] ?? null;

        $meta = $data['name'] ?? null;

        DB::beginTransaction();

        try {
            $icon = ($this->getOrCreateIconAction)($input, $meta);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem creating the icon.'));
        }

        DB::commit();

        return $icon;
    }
}
