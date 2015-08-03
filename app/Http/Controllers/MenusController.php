<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\MenuGroupInterface;
use App\Contracts\Repositories\MenuInterface;
use App\Contracts\Repositories\MenuItemInterface;
use App\Contracts\Repositories\PageInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class MenusController extends Controller
{

    private $menu;
    private $page;
    private $group;
    private $item;

    /**
     * MenusController constructor.
     *
     * @param $menu
     */
    public function __construct(MenuInterface $menu, PageInterface $page, MenuGroupInterface $group, MenuItemInterface $item)
    {
        $this->menu = $menu;
        $this->page = $page;
        $this->group = $group;
        $this->item = $item;
    }


    /**
     * Display a listing of the resource.
     * GET /menus
     *
     * @return Response
     */
    public function index()
    {
        $menuGroups = $this->group->with(["items"=>function($query){
            $query->orderBy("order", "asc");
        }])->get();
        return view('back.menus.index',compact('menuGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /menus/create
     *
     * @return Response
     */
    public function create()
    {
        $internalUrls = array();
        $lists = $this->page->active()->lists('url');
        foreach($lists as $list)
        {
            $internalUrls[$list] = $list;
        }
        return view('back.menus.groups.create',compact('internalUrls'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /menus
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data["lang_id"] = Cache::get('default_language')->id;
        $this->group->create($data);
        return redirect()->route('admin.menus.index');

    }

    /**
     * Display the specified resource.
     * GET /menus/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /menus/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $menuItem = $this->menu->findOrFail($id);
        $internalUrls = array();
        $lists = $this->page->active()->lists('url');
        foreach($lists as $list)
        {
            $internalUrls[$list] = $list;
        }
        return view('back.menus.edit',compact('menuItem','internalUrls'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /menus/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update( Request $request, $id)
    {
        $menu = $this->menu->findOrFail($id);
        $inputs = $request->all();
        if($inputs['externalUrl'])
        {
            $inputs['url'] = $inputs['externalUrl'];

            unset($inputs['externalUrl']);
            unset($inputs['internalUrl']);
        }else{
            $inputs['url'] = '/'.$inputs['internalUrl'];

            unset($inputs['externalUrl']);
            unset($inputs['internalUrl']);
        };

        $menu->update($inputs);
        return redirect()->route('admin.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /menus/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if($this->execute("\Acme\Commands\Menu\deleteMenuCommand", array('menuId'=>$id)))
        {
            if($request->json())
            {
                return array('response'=>'completed');
            }
            return redirect()->route('admin.menus.index');
        }
    }

    public function itemCreate($menuGroupId)
    {
        $internalUrls = $this->getInterUrls();
        return view('back.menus.items.create', compact('internalUrls', 'menuGroupId'));
    }
    public function itemStore(Request $request, $menuGroupId)
    {
        $inputs = $request->all();
        $inputs["menu_group_id"] = $menuGroupId;
        $inputs['externalUrl'] ? $inputs['url'] = $inputs['externalUrl'] : $inputs['url'] = '/'.$inputs['internalUrl'];
        unset($inputs['externalUrl']);
        unset($inputs['internalUrl']);

        //  Manual Set lang_id
        $language = Cache::get('default_language');
        $inputs['lang_id'] = $language->id;

        //  Set the order to be the largest within the menu group
        $order = $this->item
                ->whereMenuGroupId($inputs['menu_group_id'])
                ->max('order');
        $order == null ? $order = 0 : $order = $order + 1;
        $inputs['order'] = $order;


        $this->item->create($inputs);


        return redirect()->route('admin.menus.index');
    }

    public function itemUpdate(Request $request, $menuId)
    {
        // Ajax will only update the order and parent
        if($request->ajax())
        {
            $data = $request->get('data');
            $data = json_decode($data);
            foreach($data as $link)
            {
                $item = $this->item->findOrFail($link->id);
                $item->parent = $link->parentId;
                $item->order = $link->order;
                $item->save();
            }
            return array('response'=>'completed');
        }
        $menuItem = $this->item->findOrFail($menuId);
        $inputs = $request->all();
        $inputs['externalUrl'] ? $inputs['url'] = $inputs['externalUrl'] : $inputs['url'] = '/'.$inputs['internalUrl'];
        unset($inputs['externalUrl']);
        unset($inputs['internalUrl']);
        $menuItem->update($inputs);
        return redirect()->route('admin.menus.index')->withMessage('Menu item updated.');
    }

    public function itemEdit($menuId)
    {
        $menuItem = $this->item->findOrFail($menuId);
        $internalUrls = $this->getInterUrls();
        return view('back.menus.items.edit',compact('menuItem', 'internalUrls'));
    }

    /**
     * @return array
     */
    private function getInterUrls()
    {
        $internalUrls = array();
        $lists        = $this->page->active()->lists('url');
        foreach ($lists as $list) {
            $internalUrls[$list] = $list;
        }

        return $internalUrls;
    }

    public function itemDelete($menuId)
    {
        $menuItem = $this->item->findOrFail($menuId);
        $menuItem->delete();
        return array('response'=>'completed');
    }
}
