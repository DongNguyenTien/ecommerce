<?php

return [
    'news_manager' => [
        'text'      => 'news::menu.news_manager',
        'class'     => '',
        'icon'      => 'fa fa-newspaper-o',
        'order'     => 10,
        'sub'       => [
            /*'news_regions' => [
                'route'      => 'news.news_region.index',
                'permission' => [26,27,28,29],
                'class'      => '',
                'icon'       => 'fa fa-newspaper-o',
                'name'       => 'news_regions',
                'text'       => 'news::menu.news_regions',
                'order'      => 1,
                'sub'        => []
            ],*/
            'news_categories' => [
                'route'      => 'news.news_category.index',
                'permission' => [0,1,2,3],
                'class'      => '',
                'icon'       => 'fa fa-list-alt',
                'name'       => 'news_categories',
                'text'       => 'news::menu.news_categories',
                'order'      => 2,
                'sub'        => []
            ],
            'news_posts' => [
                'route'      => 'news.news_post.index',
                'permission' => [4,5,6,7],
                'class'      => '',
                'icon'       => 'fa fa-newspaper-o',
                'name'       => 'news_posts',
                'text'       => 'news::menu.news_posts',
                'order'      => 3,
                'sub'        => []
            ],
            'news_blocks' => [
                'route'      => 'news.news_block.index',
                'permission' => [22,23,24,25],
                'class'      => '',
                'icon'       => 'fa fa-newspaper-o',
                'name'       => 'news_blocks',
                'text'       => 'news::menu.news_blocks',
                'order'      => 3,
                'sub'        => []
            ]
        ]
    ],
];
