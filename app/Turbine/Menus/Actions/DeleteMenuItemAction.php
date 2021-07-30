<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Exceptions\GeneralException;
use App\Turbine\Menus\Models\MenuItem;
use Exception;
use Illuminate\Support\Facades\Log;

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
