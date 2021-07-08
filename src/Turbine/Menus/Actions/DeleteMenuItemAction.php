<?php

namespace Turbine\Menus\Actions;

use Exception;
use Log;
use Turbine\Exceptions\GeneralException;
use Turbine\Menus\Models\MenuItem;

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
