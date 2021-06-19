<?php

namespace App\Core\Icons\Actions;

use App\Core\Exceptions\GeneralException;
use App\Core\Icons\Models\Icon;
use App\Core\Support\Concerns\FiltersData;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Validator;

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
        Validator::make($data, [
            'meta' => ['string', 'nullable'],
        ])->validateWithBag('createIconForm');

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
