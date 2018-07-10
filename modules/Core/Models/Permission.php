<?php

namespace Modules\Core\Models;

class Permission
{
    //TODO remove Not use
    const INDEX_SCORE = 0;
    const ADD_SCORE = 1;
    const UPDATE_SCORE = 2;
    const DELETE_SCORE = 3;

    public static function getActionName($indexScore) {
        if ($indexScore == Permission::INDEX_SCORE)
            $str = 'Xem thông tin';
        elseif ($indexScore == Permission::ADD_SCORE)
            $str = "Thêm mới";
        elseif ($indexScore == Permission::UPDATE_SCORE)
            $str = "Chỉnh sửa";
        else
            $str = "Xóa1";
        return $str;
    }

    public static function getActionScore($action) {
        $arrIndex = ["index", "show"];
        $arrAdd = ["create", "store"];
        $arrDelete = ["destroy"];
        $arrEdit = ["edit", "update"];

        if (in_array($action, $arrIndex))
            return Permission::INDEX_SCORE;
        elseif (in_array($action, $arrAdd))
            return Permission::ADD_SCORE;
        elseif (in_array($action, $arrDelete))
            return Permission::DELETE_SCORE;
        else
            return Permission::UPDATE_SCORE;
    }
    //TODO remove Not use

    public static function getRequestPermissionScore($controller, $action) {
        $listPermissions = Permission::getListPermissions();
        if (isset($listPermissions[$controller]["actions"][$action])) {
            // Default action is update
            $scorePermission = $listPermissions[$controller]['actions'][$action]['id'];
            return $scorePermission;
        }
        return null;
    }

    public static function getListPermissions()
    {
        return [
            'Modules\Core\Http\Controllers\UserController' => [
                'id' => 2,
                'actions' => [
                    "index" => [
                        "id" => 8,
                        "name" => trans('core::listPermission.view')
                    ],
                    "show" => [
                        "id" => 8,
                        "name" => trans('core::listPermission.view')
                    ],
                    "create" => [
                        "id" => 9,
                        "name" => trans('core::listPermission.create')
                    ],
                    "store" => [
                        "id" => 9,
                        "name" => trans('core::listPermission.create')
                    ],
                    "edit" => [
                        "id" => 10,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "update" => [
                        "id" => 10,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "destroy" => [
                        "id" => 11,
                        "name" => trans('core::listPermission.delete')
                    ],
                ],
                'name' => trans('core::listPermission.name_user')
            ],
            'Modules\Core\Http\Controllers\RoleController' => [
                'id' => 3,
                'actions' => [
                    "index" => [
                        "id" => 12,
                        "name" => trans('core::listPermission.view')
                    ],
                    "show" => [
                        "id" => 12,
                        "name" => trans('core::listPermission.view')
                    ],
                    "create" => [
                        "id" => 13,
                        "name" => trans('core::listPermission.create')
                    ],
                    "store" => [
                        "id" => 13,
                        "name" => trans('core::listPermission.create')
                    ],
                    "edit" => [
                        "id" => 14,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "update" => [
                        "id" => 14,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "destroy" => [
                        "id" => 15,
                        "name" => trans('core::listPermission.delete')
                    ]
                ],
                'name' => trans('core::listPermission.name_role')
            ],
            'Modules\Core\Http\Controllers\GroupController' => [
                'id' => 4,
                'actions' => [
                    "index" => [
                        "id" => 16,
                        "name" => trans('core::listPermission.view')
                    ],
                    "show" => [
                        "id" => 16,
                        "name" => trans('core::listPermission.view')
                    ],
                    "create" => [
                        "id" => 17,
                        "name" => trans('core::listPermission.create')
                    ],
                    "store" => [
                        "id" => 17,
                        "name" => trans('core::listPermission.create')
                    ],
                    "edit" => [
                        "id" => 18,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "update" => [
                        "id" => 18,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "destroy" => [
                        "id" => 19,
                        "name" => trans('core::listPermission.delete')
                    ]
                ],
                'name' => trans('core::listPermission.name_group')
            ],

            'Modules\News\Http\Controllers\NewsCategoryController' => [
                'id' => 0,
                'actions' => [
                    "index" => [
                        "id" => 30,
                        "name" => trans('core::listPermission.view')
                    ],
                    "show" => [
                        "id" => 30,
                        "name" => trans('core::listPermission.view')
                    ],
                    "create" => [
                        "id" => 1,
                        "name" => trans('core::listPermission.create')
                    ],
                    "store" => [
                        "id" => 1,
                        "name" => trans('core::listPermission.create')
                    ],
                    "edit" => [
                        "id" => 2,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "update" => [
                        "id" => 2,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "destroy" => [
                        "id" => 3,
                        "name" => trans('core::listPermission.delete')
                    ]
                ],
                'name' => trans('core::listPermission.name_category')
            ],

            'Modules\News\Http\Controllers\NewsPostController' => [
                'id' => 1,
                'actions' => [
                    "index" => [
                        "id" => 4,
                        "name" => trans('core::listPermission.view')
                    ],
                    "show" => [
                        "id" => 4,
                        "name" => trans('core::listPermission.view')
                    ],
                    "create" => [
                        "id" => 5,
                        "name" => trans('core::listPermission.create')
                    ],
                    "store" => [
                        "id" => 5,
                        "name" => trans('core::listPermission.create')
                    ],
                    "edit" => [
                        "id" => 6,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "update" => [
                        "id" => 6,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "destroy" => [
                        "id" => 7,
                        "name" => trans('core::listPermission.delete')
                    ]
                ],
                'name' => trans('core::listPermission.name_post')
            ],

            'Modules\News\Http\Controllers\BlockController' => [
                'id' => 6,
                'actions' => [
                    "index" => [
                        "id" => 22,
                        "name" => trans('core::listPermission.view')
                    ],
                    "show" => [
                        "id" => 22,
                        "name" => trans('core::listPermission.view')
                    ],
                    "create" => [
                        "id" => 23,
                        "name" => trans('core::listPermission.create')
                    ],
                    "store" => [
                        "id" => 23,
                        "name" => trans('core::listPermission.create')
                    ],
                    "edit" => [
                        "id" => 24,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "update" => [
                        "id" => 24,
                        "name" => trans('core::listPermission.edit')
                    ],
                    "destroy" => [
                        "id" => 25,
                        "name" => trans('core::listPermission.delete')
                    ]
                ],
                'name' => trans('core::listPermission.name_block')
            ],

        ];
    }
}
