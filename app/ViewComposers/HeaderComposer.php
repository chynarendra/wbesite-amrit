<?php

namespace App\ViewComposers;

use App\Models\HeaderMenu;
use App\Repository\office\OfficeRepositroy;
use Illuminate\View\View;

class HeaderComposer {

    protected $officeRepositroy;
    public function __construct(OfficeRepositroy $officeRepositroy){
        $this->officeRepositroy=$officeRepositroy;
    }

    public function compose(View $view){
        $headOfficeDetail=$this->officeRepositroy->getHeadOfficeDetail();
        $headerMenus=HeaderMenu::where('status','active')->orderBy('display_order','ASC')->get();
        $view->with('headOfficeDetail', $headOfficeDetail)->with('headerMenus',$headerMenus);
    }
}

?>