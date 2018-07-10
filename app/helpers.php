<?php


if (!function_exists('category_parent')) {
    $all = [];
    
    function category_parent($data, $parent = 0, $str = '')
    {
        $category = [];
        foreach ($data as $val) {
            $tmpArray = array();
            if ($val->parent_id == $parent) {
                $category[] = ['id' => $val->id, 'name' => $str . $val->name, 'parent_id' => $val->parent_id, 'slug' => $val->slug];
                $tmpArray = category_parent($data, $val->id, $str . '--');
            }
            $category = $category + $tmpArray;
        }
        
        return $category;
    }
}

if (!function_exists('menuAdd')) {
    
    
    function menuAdd($data, $parent = 0, $str = '', $count = 0)
    {
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                echo "<option value='" . $val->id . "'>" . $str . $val->name . "</option>";
                if ($count < 1) {
                    menuAdd($data, $val->id, $str . '--', $count + 1);
                }
            }
        }
        
    }
    
}

if (!function_exists('menuEdit')) {
    
    function menuEdit($data, $itemCat, $parent = 0, $str = '', $count = 0)
    {
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                $select = ($itemCat == $val->id) ? 'selected' : '';
                echo "<option $select value='" . $val->id . "' ".$select.">" . $str . $val->name . "</option>";
                if ($count < 1) {
                    menuEdit($data, $itemCat, $val->id, $str . '--', $count + 1);
                }
            }
        }
    }
}


if (!function_exists('menuAddInPost')) {
    
    
    function menuAddInPost($data, $listCatePermission, $parent = 0, $str = '', $padding = 0, $level = 1)
    {
        
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                if ($level != 3) {
                    echo "<div class='checkbox' style='padding-left:" . $padding . "px'><i class='glyphicon glyphicon-option-horizontal'></i><label>" . $str . $val->name . "</label></div>";
                } else {
                    $flag = 0;
                    foreach ($listCatePermission as $itemPermission) {
                        if ($val->id == $itemPermission) {
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "'/>    " . $str . $val->name . "</label></div>";
                            $flag = 1;
                        }
                    }
                    
                    if ($flag == 0) {
                        if($val->created_id == \Illuminate\Support\Facades\Auth::id()){
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "'/>    " . $str . $val->name . "</label></div>";
                        }else{
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "' Disabled/>    " . $str . $val->name . "</label></div>";
                        }
                    }
                }
                
                menuAddInPost($data, $listCatePermission, $val->id, $str, $padding + 20, $level + 1);
            }
        }
    }
    
}


if (!function_exists('menuEditInPost')) {
    
    
    function menuEditInPost($old_cate_id, $data, $listCatePermission, $listCategoryCreated,$parent = 0, $str = '', $padding = 0, $level = 1)
    {
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                if (in_array($val->id,$old_cate_id)) {
                    if ($level != 3) {
                        echo "<div class='checkbox' style='padding-left:" . $padding . "px'><i class='glyphicon glyphicon-option-horizontal'></i><label>" . $str . $val->name . "</label></div>";
                    }
                    else {
                        if((in_array($val->id,$listCatePermission))||(in_array($val->id,$listCategoryCreated))){
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "' checked />    " . $str . $val->name . "</label></div>";
                        }

                        else {
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "' checked Disabled/>    " . $str . $val->name . "</label></div>";
                            echo "<input type='hidden' name='category[]' value='" . $val->id . "' > ";
                        }
                    }
                }

                else {
                    if ($level != 3) {
                        echo "<div class='checkbox' style='padding-left:" . $padding . "px'><i class='glyphicon glyphicon-option-horizontal'></i><label>" . $str . $val->name . "</label></div>";
                    }
                    else {
                        if((in_array($val->id,$listCatePermission))||(in_array($val->id,$listCategoryCreated))) {
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "' />    " . $str . $val->name . "</label></div>";
                        }
                        else {
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  name='category[]' value='" . $val->id . "' Disabled/>    " . $str . $val->name . "</label></div>";
                        }
                    }
                }
                menuEditInPost($old_cate_id, $data, $listCatePermission, $listCategoryCreated,$val->id, $str, $padding + 20, $level + 1);
            }
            
        }
    }
    
}


if (!function_exists('menuAddInRole')) {
    
    
    function menuAddInRole($data, $parent = 0, $str = 0, $padding = 0)
    {
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                if ($str != '') {
                    echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox'  class=$str  name='category[]' value='" . $val->id . "'/>      " . $val->name . "</label></div>";
                } else {
                    echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox' class='0'  name='category[]' value='" . $val->id . "'/>      " . $val->name . "</label></div>";
                }
                menuAddInRole($data, $val->id, $val->id, $padding + 20);
                
            }
        }
    }
    
}

if (!function_exists('menuEditInRole')) {
    
    
    function menuEditInRole($old_cate_id, $data, $parent = 0, $str = '', $padding = 0)
    {
        $flag = 0;
        foreach ($data as $val) {
            if ($val->parent_id == $parent) {
                $flag = 0;
                foreach ($old_cate_id as $item) {
                    if ($val->id == $item) {
                        if ($str != '') {
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox' class=$str  name='category[]' value='" . $val->id . "' checked />      " . $val->name . "</label></div>";
                        } else {
                            echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox' class='0' name='category[]' value='" . $val->id . "' checked />       " . $val->name . "</label></div>";
                        }
                        $flag = 1;
                    }
                }
                if ($flag != 1) {
                    if ($str != '') {
                        echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox' class=$str name='category[]' value='" . $val->id . "'/>       " . $val->name . "</label></div>";
                    } else {
                        echo "<div class='checkbox' style='padding-left:" . $padding . "px'><label><input type='checkbox' class='0' name='category[]' value='" . $val->id . "'/>" . $val->name . "</label></div>";
                    }
                }
                menuEditInRole($old_cate_id, $data, $val->id, $val->id, $padding + 20);
            }
            
        }
    }
    
}

if (!function_exists('menuIndexPost')) {
    
    
    function menuIndexPost($categories, $parent = 0, $str = '', $count = 0)
    {
        foreach ($categories as $val) {
            if ($val->parent_id == $parent) {
                echo "<option value='" . $val->id . "'" . (old('category') == $val->id ? 'selected="selected" ' : '') . " >" . $str . $val->name . "</option>";
                if ($count < 2) {
                    menuIndexPost($categories, $val->id, $str . '--', $count + 1);
                }
            }
        }
        
    }
    
}


?>