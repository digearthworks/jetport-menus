<?php

namespace App\MenuSystem\Http;

use App\MenuSystem\MenuService;
use App\Models\Menu;

class MenuController
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $data = [
            'menus' => $this->menuService->getAllMenus(),
        ];

        return view('frontend.menus.index', $data);
    }

    public function manage()
    {
        return view('frontend.menus.manage');
    }

    public function create()
    {
        return view('frontend.menus.edit', ['menu' => '']);
    }

    public function store(MenuRequest $request)
    {
        $menu = $this->menuService->store($request->all());

        return redirect('/menus/edit/'. $menu->id)->withFlashSuccess(__('The Menu was successfully created.'));
    }

    public function show(Menu $menu)
    {
        $parent = $menu->parent;

        if (isset($parent->id)) {
            return redirect('/menus/' . $parent->id);
        }

        return view('frontend.menus.show', $this->menuService->getMenuGrid($menu));
    }

    public function edit(Menu $menu)
    {
        $data = [
            'menu' => $this->menuService->getMenu($menu),
            'hotlinksGroupMeta' => $this->menuService->getGroupMetaForHotlinkChildren($menu),
            'itemsGroupMeta' => $this->menuService->getGroupMetaForItems($menu),
            'menuHasHotlinks' => $this->menuService->menuHasHotlinks($menu),
            'menuHasItems' => $this->menuService->menuHasItems($menu),
            'menuGrid' => $this->menuService->getMenuGrid($menu),
        ];

        return view('frontend.menus.manage', $data);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        if ($updatedMenu = $this->menuService->update($request, $menu)) {
            return redirect('/menus/edit/'.$updatedMenu->id)->withFlashSuccess('Menu has been updated');
        }

        return back();
    }

    public function destroy(Menu $menu)
    {
        $this->menuService->destroy($menu);

        return  redirect('/menus')->withFlashSuccess('Menu item deleted');
    }
}
