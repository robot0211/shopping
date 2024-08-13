<?php

namespace App\Components;

use App\Models\Menu;

class MenuRecusive{
    private $data;
    private $html='';
    public function __construct($data)
    {
        $this->data = $data;
    }

    function menuRecusive($parentId, $id=0, $text='')
    {

        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if ( !empty($parentId) && $parentId == $value['id']) {
                    $this->html .= "<option selected value=' ". $value['id'] ." '>" . $text . $value['name'] . "</option>";
                }else {
                    $this->html .= "<option value=' ". $value['id'] ." '>" . $text . $value['name'] . "</option>";
                }
                
                $this->menuRecusive($parentId, $value['id'], $text . '---');
            }
        }
        return $this->html;
    }
}