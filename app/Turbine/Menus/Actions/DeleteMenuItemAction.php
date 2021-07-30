<?php

namespace App\Turbine\Menus\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Turbine\Exceptions\GeneralException;
use App\Turbine\Menus\Models\MenuItem;

class DeleteMenuItemAction
{
    public function __invoke(MenuItem $menuItem)
    {
        try {
            $menuItem->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());

            throw new GeneralException('There was a problem deleting the item');
        }
    }
}
