<?php
$prefix = 'kt_';

$key    = 'kt_options';

global $wp_registered_sidebars;

$sidebars = array();

foreach ( $wp_registered_sidebars as $sidebar ) {
    $sidebars[ $sidebar['id'] ] = $sidebar['name'];
}
$mailchip_list = array();
if( class_exists('MCAPI')){

    $kt_mailchimp_option = get_option('kt_mailchimp_option',true);
    if( $kt_mailchimp_option && $kt_mailchimp_option['api_key']){
        $api_key = $kt_mailchimp_option['api_key'];
        
        $mcapi = new MCAPI($api_key);
        $lists = $mcapi->lists();
        if ($lists['data'] && count( $lists['data'] ) >0 ) {
            foreach ($lists['data']as $key => $list) {
                $mailchip_list[$list['id']] = $list['default_from_name'];
            }
        }
    }
    
}


$config = array(
    //General
    $prefix . 'generals' => array(
        'title'   => 'General',
        'type'    => 'wrapper',
        'cmb'     => array (
            //Logo
            $prefix . 'logo_favicon' =>  array(
                'setting' => array(
                    'id'      => $prefix . 'logo_favicon',
                    'title'   => 'Logo',
                    'hookup'  => false,
                    'show_on' => array(
                        // These are important, don't remove
                        'key'   => 'options-page',
                        'value' => array( $key )
                    )
                ),
                'fields'    => array(
                    array(
                        'name'    => __( 'Logo', 'kutetheme' ),
                        'id'      => 'kt_logo',
                        'type'    => 'file',
                        'desc'    => __( 'Setting your site\'s logo', 'kutetheme' ),
                    ),
                    array(
                        'name'    => __( 'Logo Footer', 'kutetheme' ),
                        'id'      => 'kt_logo_footer',
                        'type'    => 'file',
                        'desc'    => __( 'Setting your site\'s logo in footer', 'kutetheme' ),
                    ),
                    array(
                        'name'    => __( 'Favicon', 'kutetheme' ),
                        'id'      => 'kt_favicon',
                        'type'    => 'file',
                        'desc'    => __( 'Setting your site\'s favicon', 'kutetheme' ),
                    )
                )
            ),
           //  $prefix . 'default_page' => array(
           //      'setting' => array( 
           //          'id'      => $prefix . 'default_page',
        			// 'hookup'  => false,
           //          'title'   => 'Page',
        			// 'show_on' => array(
        			// 	// These are important, don't remove
        			// 	'key'   => 'options-page',
        			// 	'value' => array( $key )
        			// ) 
           //      ),
           //      'fields'    => array(
           //          array(
           //      		'name'    => __( 'Page Service', 'kutetheme' ),
           //      		'id'      => 'kt_page_service',
           //      		'type'    => 'page_select',
           //              'desc'    => __( 'Setting page service', 'kutetheme' ),
           //      	),
           //          array(
           //      		'name'    => __( 'Page Support', 'kutetheme' ),
           //      		'id'      => 'kt_page_support',
           //      		'type'    => 'page_select',
           //              'desc'    => __( 'Setting page support ', 'kutetheme' ),
           //      	),
           //          array(
           //      		'name'    => __( 'About Us', 'kutetheme' ),
           //      		'id'      => 'kt_page_about_us',
           //      		'type'    => 'page_select',
           //              'desc'    => __( 'Setting page about us', 'kutetheme' ),
           //      	)
           //      )
           //  ),
            $prefix . 'default_sidebar' => array(
                'setting' => array( 
                    'id'      => $prefix . 'default_sidebar',
        			'hookup'  => false,
                    'title'   => 'Sidebar',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => __( 'Shop layout', 'koolshop' ),
                        'id'      => 'kt_sidebar_are',
                        'type'    => 'radio_image',
                        'default' => 'left',
                        'options' => array(
                            'left'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/2cl.png',
                            'right' => KUTETHEME_PLUGIN_URL .'/assets/imgs/2cr.png',
                            'full'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/1column.png',
                        ),
                        'desc'    => __( 'Setting layuout shop page', 'koolshop' )
                    ),
                    array(
                		'name'    => __( 'Choose sidebar', 'kutetheme' ),
                		'id'      => 'kt_used_sidebar',
                		'type'    => 'sidebar_select',
                		'default' => 'sidebar-primary',
                        'desc'    => __( 'Setting sidebar in the area sidebar', 'kutetheme' ),
                        'dependency' => array(
                            'id'    => 'kt_sidebar_are',
                            'value' => array( 'left','right')
                        ),
                	)
                )
            ),
		)
    ),
    //Header
    $prefix . 'header' => array(
        'title'   => 'Header',
        'type'    => 'wrapper',
        'cmb'     => array (
            $prefix . 'default_header' => array(
                'setting' => array( 
                    'id'      => $prefix . 'default_header',
        			'hookup'  => false,
                    'title'   => 'General',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => __( 'Header', 'koolshop' ),
                        'id'      => 'kt_used_header',
                        'type'    => 'select2',
                        'default' => '1',
                        'options' => array(
                            '1' => array(
                                'label' => 'Header style 01',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v1.jpg',
                            ),
                            '2' => array(
                                'label' => 'Header style 02',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v2.jpg',
                            ),
                            '3' => array(
                                'label' => 'Header style 03',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v3.jpg',
                            ),
                            '4' => array(
                                'label' => 'Header style 04',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v4.jpg',
                            ),
                            '5' => array(
                                'label' => 'Header style 05',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v5.jpg',
                            ),
                            '6' => array(
                                'label' => 'Header style 06',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v6.jpg',
                            ),
                            '7' => array(
                                'label' => 'Header style 07',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v7.jpg',
                            ),
                            '8' => array(
                                'label' => 'Header style 08',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v8.jpg',
                            ),
                            '9' => array(
                                'label' => 'Header style 09',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v9.jpg',
                            ),
                            '10' => array(
                                'label' => 'Header style 10',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v10.jpg',
                            ),
                            '11' => array(
                                'label' => 'Header style 11',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v11.jpg',
                            ),
                            '12' => array(
                                'label' => 'Header style 12',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v12.jpg',
                            ),
                            '13' => array(
                                'label' => 'Header style 13',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/v13.jpg',
                            ),
                        ),
                    ),

                    /* Header 03*/
                    array(
                        'name' => __( 'Ads text', 'kutetheme' ),
                        'desc' => __( 'Display ads text only header style 3', 'kutetheme' ),
                        'id'   => 'kt_header_message',
                        'type' => 'text',
                        'dependency' => array(
                            'id'    => 'kt_used_header',
                            'value' => array( '3')
                        ),
                    ),
                    /* HEADER 7 */
                    array(
                        'name'       => __( 'Category Service', 'kutetheme' ),
                        'id'         => 'kt_service_cate',
                        'type'       => 'taxonomy_select',
                        'taxonomy'   => 'service_cat',
                        'desc'       => __( 'Setting category service in header 7', 'kutetheme' ),
                        'show_option_none' => 'Choose Category',
                        'dependency' => array(
                            'id'    => 'kt_used_header',
                            'value' => array( '7')
                        ),
                    ),
                    /* HEDER 9*/
                    array(
                        'name'    => __( 'Enable Header postion', 'kutetheme' ),
                        'id'      => 'kt_enable_header9_postion',
                        'type'    => 'select',
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                        'dependency' => array(
                            'id'    => 'kt_used_header',
                            'value' => array( '9')
                        ),
                    ),
                    /* HEADER 11*/
                    array(
                        'name'    => __( 'Enable Box contact info', 'kutetheme' ),
                        'id'      => 'kt_enable_box_contact_info11',
                        'type'    => 'select',
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                        'dependency' => array(
                            'id'    => 'kt_used_header',
                            'value' => array( '11')
                        ),
                    ),
                    array(
                        'name'    => __( 'Enable Hot line on contact info', 'kutetheme' ),
                        'id'      => 'kt_enable_hotline_contact_info11',
                        'type'    => 'select',
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                        'dependency' => array(
                            'id'    => 'kt_used_header',
                            'value' => array( '11')
                        ),
                    ),
                    array(
                        'name'    => __( 'Enable Social on contact info', 'kutetheme' ),
                        'id'      => 'kt_enable_social_contact_info11',
                        'type'    => 'select',
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                        'dependency' => array(
                            'id'    => 'kt_used_header',
                            'value' => array( '11')
                        ),
                    ),
                )
            ),
            $prefix . 'enable_hook' => array(
                'setting' => array( 
                    'id'      => $prefix . 'enable_hook',
                    'hookup'  => false,
                    'title'   => 'Enable hook',
                    'show_on' => array(
                        // These are important, don't remove
                        'key'   => 'options-page',
                        'value' => array( $key )
                    ) 
                ),
                'fields'    => array(
                    array(
                        'name'    => __( 'My Account box', 'kutetheme' ),
                        'id'      => 'kt_enable_myaccount_box',
                        'type'    => 'select',
                        'desc'    => __( 'Setting My Account box display', 'kutetheme' ),
                        'show_option_none' => 0,
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                    )
                )
            ),
            $prefix . 'vertical_menu' => array(
                'setting' => array( 
                    'id'      => $prefix . 'vertical_menu',
        			'hookup'  => false,
                    'title'   => 'Vertical Menu',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => __( 'User Vertical Menu', 'kutetheme' ),
                        'id'      => 'kt_enable_vertical_menu',
                        'type'    => 'select',
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                        'desc'    => __( 'Use Vertical Menu on show any page', 'kutetheme' ),
                    ),
                    array(
                        'name'    => __( 'Collapse', 'kutetheme'),
                        'id'      => 'kt_click_open_vertical_menu',
                        'type'    => 'select',
                        'default' => 'disable',
                        'options' => array(
                            'enable'  => 'Enable',
                            'disable'  => 'Disable'
                        ),
                        'desc'    => __( 'Vertical menu will expand on click', 'kutetheme' ),
                    ),
                    array(
                        'name'    => __( 'The number of visible vertical menu items', 'kutetheme' ),
                        'desc'    => __( 'The number of visible vertical menu items', 'kutetheme' ),
                        'id'      => 'kt_vertical_item_visible',
                        'default' =>11,
                        'type'    => 'numeric',
                    )
                )
            ),
		),
    ),
    //Footer
    $prefix . 'footer' => array(
        'title'   => 'Footer',
        'type'    => 'wrapper',
        'cmb'     => array (
            $prefix . 'default_footer' => array(
                'setting' => array( 
                    'id'      => $prefix . 'default_footer',
        			'hookup'  => false,
                    'title'   => 'Footer Settings',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => __( 'Footer', 'koolshop' ),
                        'id'      => 'kt_footer_style',
                        'type'    => 'select2',
                        'default' => '1',
                        'options' => array(
                            '1' => array(
                                'label' => 'Footer style 01',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/fv1.jpg',
                            ),
                            '2' => array(
                                'label' => 'Footer style 02',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/fv2.jpg',
                            ),
                            '3' => array(
                                'label' => 'Footer style 03',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/fv3.jpg',
                            ),
                            '4' => array(
                                'label' => 'Footer style 04',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/fv4.jpg',
                            ),
                            '5' => array(
                                'label' => 'Footer style 05',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/fv5.jpg',
                            ),
                            '6' => array(
                                'label' => 'Footer style 06',
                                'attr'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/fv6.jpg',
                            ),
                        ),
                    ),
                    /*FOOTER 2*/
                    array(
                        'name'    => __( 'Footer Background', 'kutetheme' ),
                        'id'      => 'kt_footer_background',
                        'type'    => 'file',
                        'desc'    => __( 'Display Background on footer style 2', 'kutetheme' ),
                        'dependency' => array(
                            'id'    => 'kt_footer_style',
                            'value' => array( '2')
                        ),
                    ),
                    array(
                        'name'    => __( 'Footer Payment logo', 'kutetheme' ),
                        'id'      => 'kt_footer_payment_logo',
                        'type'    => 'file',
                        'desc'    => __( 'Display payment logo on footer style 2', 'kutetheme' ),
                        'dependency' => array(
                            'id'    => 'kt_footer_style',
                            'value' => array( '2')
                        ),
                    ),
                    array(
                        'name'    => __( 'Subscribe newsletter title', 'kutetheme' ),
                        'desc'    => __( 'Subscribe newsletter title display on footer style 2', 'kutetheme' ),
                        'id'      => 'kt_footer_subscribe_newsletter_title',
                        'type'    => 'text',
                        'default' => 'SIGN UP BELOW FOR EARLY UPDATES',
                        'dependency' => array(
                            'id'    => 'kt_footer_style',
                            'value' => array( '2')
                        ),
                    ),
                    array(
                        'name'    => __( 'Subscribe newsletter description', 'kutetheme' ),
                        'desc'    => __( 'Subscribe newsletter description display on footer style 2', 'kutetheme' ),
                        'id'      => 'kt_footer_subscribe_newsletter_description',
                        'type'    => 'text',
                        'default' => 'You a Client , large or small, and want to participate in this adventure, please send us an email to support@kuteshop.com',
                        'dependency' => array(
                            'id'    => 'kt_footer_style',
                            'value' => array( '2')
                        ),
                    ),
                    array(
                        'name'    => __( 'Mailchip List', 'kutetheme' ),
                        'id'      => 'kt_footer_subscribe_newsletter_list_id',
                        'type'    => 'select',
                        'default' => '',
                        'options' => $mailchip_list,
                        'dependency' => array(
                            'id'    => 'kt_footer_style',
                            'value' => array( '2')
                        ),
                    ),
                    /* FOOTER 4,5 */
                    array(
                        'name'    => __( 'Footer Payment logos', 'kutetheme' ),
                        'id'      => 'kt_footer_payment_logos',
                        'type'    => 'file_list',
                        'desc'    => __( 'Display payment logos on footer style 4, 5', 'kutetheme' ),
                        'options' => array(
                            'url' => false, // Hide the text input for the url
                            'add_upload_file_text' => 'Add payment images' // Change upload button text. Default: "Add or Upload File"
                        ),
                        'dependency' => array(
                            'id'    => 'kt_footer_style',
                            'value' => array( '4','5')
                        ),
                    ),
                    array(
                		'name' => __( 'Copyrights', 'kutetheme' ),
                		'desc' => __( 'Copyrights your site', 'kutetheme' ),
                		'id'   => 'kt_copyrights',
                		'type' => 'textarea',
                	)
                )
            ),
            // $prefix . 'footer_4' => array(
            //     'setting' => array( 
            //         'id'      => $prefix . 'footer_4',
            //         'hookup'  => false,
            //         'title'   => 'Footer 4, 5',
            //         'show_on' => array(
            //             // These are important, don't remove
            //             'key'   => 'options-page',
            //             'value' => array( $key )
            //         ) 
            //     ),
            //     'fields'    => array(
            //         array(
            //             'name'    => __( 'Footer Payment logos', 'kutetheme' ),
            //             'id'      => 'kt_footer_payment_logos',
            //             'type'    => 'file_list',
            //             'desc'    => __( 'Display payment logos on footer style 4, 5', 'kutetheme' ),
            //             'options' => array(
            //                 'url' => false, // Hide the text input for the url
            //                 'add_upload_file_text' => 'Add payment images' // Change upload button text. Default: "Add or Upload File"
            //             ),
            //         ),
            //     )
            // ),
		),
    ),
    //Color
    $prefix . 'color' => array(
        'title'   => 'Color',
        'type'    => 'wrapper',
        'cmb'     => array (
            $prefix . 'general_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'general_color',
        			'hookup'  => false,
                    'title'   => 'General',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'Main Color',
                        'id'      => 'main_color',
                        'type'    => 'colorpicker',
                        'default' => '#ff3366',
                    ),
                    array(
                        'name'    => 'Background Color',
                        'id'      => 'bg_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Price Color',
                        'id'      => 'price_color',
                        'type'    => 'colorpicker',
                        'default' => '#ff3366',
                    )
                )
            ),
            
            $prefix . 'vm_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'vm_color',
        			'hookup'  => false,
                    'title'   => 'Vertical Menu',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'Background Color',
                        'id'      => 'vm_bg_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Text Color',
                        'id'      => 'vm_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#666',
                    ),
                    array(
                        'name'    => 'Menu Item Hover Bg Color ',
                        'id'      => 'vm_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ff3366',
                    ),
                    array(
                        'name'    => 'Text Hover Color',
                        'id'      => 'vm_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    )
                )
            ),
            //Color Header 1
            $prefix . 'header_1_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_1_color',
        			'hookup'  => false,
                    'title'   => 'Header 1',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h1_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f6f6f6',
                    ),
                    array(
                        'name'    => 'Mega Menu Bg Color',
                        'id'      => 'h1_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#eee',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h1_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#000',
                    ),
                    array(
                        'name'    => 'Item Mega Menu Border Color',
                        'id'      => 'h1_mega_menu_border',
                        'type'    => 'colorpicker',
                        'default' => '#cacaca',
                    ),
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h1_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#f6f6f6',
                    ),
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h1_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#666',
                    ),
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h1_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h1_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h1_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Menu Item Hover Bg Color',
                        'id'      => 'h1_item_mege_menu_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ff3366',
                    ),
                )
            ),
            //Color Header 2
            $prefix . 'header_2_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_2_color',
        			'hookup'  => false,
                    'title'   => 'Header 2',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h2_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f6f6f6',
                    ),
                    array(
                        'name'    => 'Mega Menu Bg Color',
                        'id'      => 'h2_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#958457',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h2_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#4c311d',
                    ),
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h2_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#666',
                    ),
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h2_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h2_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h2_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#4c311d',
                    ),
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h2_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Menu Item Hover Bg Color ',
                        'id'      => 'h2_item_mege_menu_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ab9d77',
                    ),
                )
            ),
            //Color Header 3
            $prefix . 'header_3_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_3_color',
        			'hookup'  => false,
                    'title'   => 'Header 3',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h3_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f6f6f6',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h3_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                    array(
                        'name'    => 'Mega Menu Bg Color(OnTop)',
                        'id'      => 'h3_mega_menu_bg_ontop',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h3_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#666',
                    ),
                    array(
                        'name'    => 'Mega Menu Text Color(OnTop)',
                        'id'      => 'h3_mege_menu_text_color_ontop',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h3_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h3_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h3_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                    array(
                        'name'    => 'Mega Menu Hover Text Color(OnTop)',
                        'id'      => 'h3_mege_menu_hover_text_color_ontop',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Menu Item Hover Bg Color(OnTop)',
                        'id'      => 'h3_item_mege_menu_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#31a5df',
                    ),
                )
            ),
            //Color Header 4
            $prefix . 'header_4_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_4_color',
        			'hookup'  => false,
                    'title'   => 'Header 4',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h4_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f6f6f6',
                    ),
                    
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h4_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                    
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h4_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#666',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h4_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#333',
                    ),
                    
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h4_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h4_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h4_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#0088cc',
                    ),
                )
            ),
            
            //Color Header 5
            $prefix . 'header_5_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_5_color',
        			'hookup'  => false,
                    'title'   => 'Header 5',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h5_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f6f6f6',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Bg Color',
                        'id'      => 'h5_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#eee',
                    ),
                    
                    array(
                        'name'    => 'Nav Mega Menu Bg Color',
                        'id'      => 'h5_nav_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f96d10',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h5_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#e80000',
                    ),
                    
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h5_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#666',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h5_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h5_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h5_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#f96d10',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h5_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Menu Item Hover Bg Color',
                        'id'      => 'h5_item_mege_menu_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#e80000',
                    ),
                )
            ),
            //Color Header 6
            $prefix . 'header_6_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_6_color',
        			'hookup'  => false,
                    'title'   => 'Header 6',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h6_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#007176',
                    ),
                    
                    array(
                        'name'    => 'Header Bg Color',
                        'id'      => 'h6_header_bg',
                        'type'    => 'colorpicker',
                        'default' => '#008a90',
                    ),
                    array(
                        'name'    => 'Mega Menu Bg Color',
                        'id'      => 'h6_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#008a90',
                    ),
                    
                    array(
                        'name'    => 'Nav Mega Menu Bg Color',
                        'id'      => 'h6_nav_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#007176',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h6_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#000',
                    ),
                    array(
                        'name'    => 'Search Box Bg Color',
                        'id'      => 'h6_search_box_bg',
                        'type'    => 'colorpicker',
                        'default' => '#00abb3',
                    ),
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h6_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h6_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h6_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h6_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ccc',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h6_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Menu Item Hover Bg Color',
                        'id'      => 'h6_item_mege_menu_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#00abb3',
                    ),
                )
            ),
            //Color Header 7
            $prefix . 'header_7_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_7_color',
        			'hookup'  => false,
                    'title'   => 'Header 7',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'TopBar Bg Color',
                        'id'      => 'h7_topbar_bg',
                        'type'    => 'colorpicker',
                        'default' => '#cd2600',
                    ),
                    
                    array(
                        'name'    => 'Header Bg Color',
                        'id'      => 'h7_header_bg',
                        'type'    => 'colorpicker',
                        'default' => '#e62e04',
                    ),
                    array(
                        'name'    => 'Mega Menu Bg Color',
                        'id'      => 'h7_mega_menu_bg',
                        'type'    => 'colorpicker',
                        'default' => '#e62e04',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h7_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#434343',
                    ),
                    
                    array(
                        'name'    => 'Button Box Category Bg Color',
                        'id'      => 'h7_button_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#2a2a2a',
                    ),
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h7_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h7_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h7_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h7_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ccc',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h7_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    
                    array(
                        'name'    => 'Menu Item Hover Bg Color',
                        'id'      => 'h7_item_mege_menu_bg_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#f04923',
                    ),
                )
            ),
            //Color Header 9
            $prefix . 'header_9_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_9_color',
                    'hookup'  => false,
                    'title'   => 'Header 9',
                    'show_on' => array(
                        // These are important, don't remove
                        'key'   => 'options-page',
                        'value' => array( $key )
                    ) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'Header Bg Color',
                        'id'      => 'h9_header_bg',
                        'type'    => 'colorpicker',
                        'default' => '#000',
                    ),
                    array(
                        'name'    => __( 'Header Overlay opacity', 'kutetheme' ),
                        'id'      => 'h9_header_opacity',
                        'type'    => 'select',
                        'default' => '0.6',
                        'options' => array(
                            '0.1' => '0.1',
                            '0.2' => '0.2',
                            '0.3' => '0.3',
                            '0.4' => '0.4',
                            '0.5' => '0.5',
                            '0.6' => '0.6',
                            '0.7' => '0.7',
                            '0.8' => '0.8',
                            '0.9' => '0.9',
                            '1'   => '1',
                        )
                    ),
                    array(
                        'name'    => 'Topbar color',
                        'id'      => 'h9_header_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Topbar hover color',
                        'id'      => 'h9_header_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ff6633',
                    ),
                    array(
                        'name'    => 'Topbar bg color',
                        'id'      => 'h9_topbar_bg_color',
                        'type'    => 'colorpicker',
                        'default' => '#000',
                    ),
                    array(
                        'name'    => __( 'Topbar Overlay opacity', 'kutetheme' ),
                        'id'      => 'h9_topbar_opacity',
                        'type'    => 'select',
                        'default' => '0.4',
                        'options' => array(
                            '0.1' => '0.1',
                            '0.2' => '0.2',
                            '0.3' => '0.3',
                            '0.4' => '0.4',
                            '0.5' => '0.5',
                            '0.6' => '0.6',
                            '0.7' => '0.7',
                            '0.8' => '0.8',
                            '0.9' => '0.9',
                            '1'   => '1',
                        )
                    ),
                    array(
                        'name'    => 'Topbar color',
                        'id'      => 'h9_topbar_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Topbar hover color',
                        'id'      => 'h9_topbar_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#ff6633',
                    )
                )
            ),
            //Color Header 11
            $prefix . 'header_11_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_11_color',
                    'hookup'  => false,
                    'title'   => 'Header 11',
                    'show_on' => array(
                        // These are important, don't remove
                        'key'   => 'options-page',
                        'value' => array( $key )
                    ) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'Header Bg Color',
                        'id'      => 'h11_header_bg',
                        'type'    => 'colorpicker',
                        'default' => '#f5f5f5',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h11_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#ff6633',
                    ),
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h11_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Box header bg color',
                        'id'      => 'h11_box_header_bg_color',
                        'type'    => 'colorpicker',
                        'default' => '#333',
                    ),
                    array(
                        'name'    => 'Box Contact info bg color',
                        'id'      => 'h11_box_contact_info_bg_color',
                        'type'    => 'colorpicker',
                        'default' => '#666666',
                    ),
                    array(
                        'name'    => 'Box Contact info text color',
                        'id'      => 'h11_box_contact_info_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                )
            ),
            //Color Header 12
            $prefix . 'header_12_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_12_color',
                    'hookup'  => false,
                    'title'   => 'Header 12',
                    'show_on' => array(
                        // These are important, don't remove
                        'key'   => 'options-page',
                        'value' => array( $key )
                    ) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'Header Bg Color',
                        'id'      => 'h12_header_bg',
                        'type'    => 'colorpicker',
                        'default' => '#394264',
                    ),
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h12_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#ff3366',
                    ),
                    array(
                        'name'    => 'TopBar Text Color',
                        'id'      => 'h12_topbar_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#9099b7',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Color',
                        'id'      => 'h12_mege_menu_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#9099b7',
                    ),
                    
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h12_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'TopBar Text Hover Color',
                        'id'      => 'h12_topbar_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#9099b7',
                    ),
                    
                    array(
                        'name'    => 'Mega Menu Text Hover Color',
                        'id'      => 'h12_mege_menu_text_hover_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                    array(
                        'name'    => 'Box header bg color',
                        'id'      => 'h12_box_header_bg_color',
                        'type'    => 'colorpicker',
                        'default' => '#50597b',
                    ),
                )
            ),
            //Color Header 13
            $prefix . 'header_13_color' => array(
                'setting' => array( 
                    'id'      => $prefix . 'header_13_color',
                    'hookup'  => false,
                    'title'   => 'Header 13',
                    'show_on' => array(
                        // These are important, don't remove
                        'key'   => 'options-page',
                        'value' => array( $key )
                    ) 
                ),
                'fields'    => array(
                    array(
                        'name'    => 'Box Category Bg Color',
                        'id'      => 'h13_box_category_bg',
                        'type'    => 'colorpicker',
                        'default' => '#000',
                    ),
                    array(
                        'name'    => 'Box Category Text Color',
                        'id'      => 'h13_box_category_text_color',
                        'type'    => 'colorpicker',
                        'default' => '#fff',
                    ),
                )
            ),
		),
    ),
    //Woocommerce
    $prefix . 'woocommerce' => array(
        'title'   => 'Woocommerce',
        'type'    => 'wrapper',
        
        'cmb'     => array (
            $prefix . 'default_woocommerce' => array(
                'setting' => array( 
                    'id'      => $prefix . 'default_woocommerce',
        			'hookup'  => false,
                    'title'   => 'General',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    array(
                		'name'    => __( 'Number of days newness', 'kutetheme' ),
                		'id'      => 'kt_woo_newness',
                		'type'    => 'text',
                		'default' => '7',
                        'desc'    => __( 'Number of days to treat as new product', 'kutetheme' ),
                	),
                    array(
                		'name'    => __( 'Grid column on desktop (Screen resolution of device >= 992px )', 'kutetheme' ),
                		'id'      => 'kt_woo_grid_column',
                		'type'    => 'select',
                		'default' => '3',
                        'options' => array(
                            '1' => '1 Column',
                            '2' => '2 Columns',
                            '3' => '3 Columns',
                            '4' => '4 Columns',
                            '6' => '6 Columns'
                        ),
                        'desc'    => __( 'Number column to display width gird mod', 'kutetheme' ),
                	),
                    array(
                        'name'    => __( 'Grid column on tablet (Screen resolution of device >=768px and < 992px ) ', 'kutetheme' ),
                        'id'      => 'kt_woo_grid_column_tablet',
                        'type'    => 'select',
                        'default' => '2',
                        'options' => array(
                            '1' => '1 Column',
                            '2' => '2 Columns',
                            '3' => '3 Columns',
                            '4' => '4 Columns',
                            '6' => '6 Columns'
                        ),
                        'desc'    => __( 'Number column to display width gird mod', 'kutetheme' ),
                    ),
                    array(
                        'name'    => __( 'Grid column on mobile mobile (Screen resolution of device < 768px)', 'kutetheme' ),
                        'id'      => 'kt_woo_grid_column_mobile',
                        'type'    => 'select',
                        'default' => '1',
                        'options' => array(
                            '1' => '1 Column',
                            '2' => '2 Columns',
                            '3' => '3 Columns',
                            '4' => '4 Columns',
                            '6' => '6 Columns'
                        ),
                        'desc'    => __( 'Number column to display width gird mod', 'kutetheme' ),
                    )
                )
            ),
            $prefix . 'shop_page' => array(
                'setting' => array( 
                    'id'      => $prefix . 'shop_page',
        			'hookup'  => false,
                    'title'   => 'Shop Page',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                    
                    array(
                        'name'    => __( 'Shop layout', 'koolshop' ),
                        'id'      => 'kt_woo_shop_sidebar_are',
                        'type'    => 'radio_image',
                        'default' => 'left',
                        'options' => array(
                            'left'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/2cl.png',
                            'right' => KUTETHEME_PLUGIN_URL .'/assets/imgs/2cr.png',
                            'full'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/1column.png',
                        ),
                        'desc'    => __( 'Setting Sidebar Area on shop page', 'koolshop' )
                    ),
                    array(
                		'name'    => __( 'Shop page sidebar', 'kutetheme' ),
                		'id'      => 'kt_woowoo_shop_used_sidebar',
                		'type'    => 'sidebar_select',
                		'default' => 'sidebar-shop',
                        'desc'    => __( 'Setting sidebar in the area sidebar on shop page', 'kutetheme' ),
                        'dependency' => array(
                            'id'    => 'kt_woo_shop_sidebar_are',
                            'value' => array( 'left','right' )
                        )
                	),
                    array(
                		'name'    => __( 'Products perpage', 'kutetheme' ),
                		'id'      => 'kt_woo_products_perpage',
                		'type'    => 'text',
                		'default' => '12',
                        'desc'    => __( 'Number of products on shop page', 'kutetheme' ),
                	)
                )
            ),
            $prefix . 'single_page' => array(
                'setting' => array( 
                    'id'      => $prefix . 'single_page',
        			'hookup'  => false,
                    'title'   => 'Single Product',
        			'show_on' => array(
        				// These are important, don't remove
        				'key'   => 'options-page',
        				'value' => array( $key )
        			) 
                ),
                'fields'    => array(
                 
                    array(
                        'name'    => __( 'Single Sidebar Area', 'kutetheme' ),
                        'id'      => 'kt_woo_single_sidebar_are',
                        'type'    => 'radio_image',
                        'default' => 'full',
                        'options' => array(
                            'left'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/2cl.png',
                            'right' => KUTETHEME_PLUGIN_URL .'/assets/imgs/2cr.png',
                            'full'  => KUTETHEME_PLUGIN_URL .'/assets/imgs/1column.png',
                        ),
                        'desc'    => __( 'Setting Sidebar Area on single page', 'kutetheme' )
                    ),
                    array(
                		'name'    => __( 'Single page sidebar', 'kutetheme' ),
                		'id'      => 'kt_woo_single_used_sidebar',
                		'type'    => 'sidebar_select',
                		'default' => 'full',
                        'options' => $sidebars,
                        'desc'    => __( 'Setting sidebar in the area sidebar on single page', 'kutetheme' ),
                        'dependency' => array(
                            'id'    => 'kt_woo_single_sidebar_are',
                            'value' => array( 'left','right' )
                        )
                	),
                    array(
                        'name'    => __( 'Product thumb slider', 'kutetheme' ),
                        'id'      => 'kt_enable_product_thumb_slider',
                        'type'    => 'select',
                        'default' => 'yes',
                        'options' => array(
                            'yes'  => 'Enable',
                            'no'  => 'Disable',
                        ),
                    ),
                )
            )
		),
    ),
    //Social
    $prefix . 'social' =>  array(
        'setting' => array(
            'id'      => $prefix . 'social',
            'title'   => 'Socials',
    		'hookup'  => false,
    		'show_on' => array(
    			// These are important, don't remove
    			'key'   => 'options-page',
    			'value' => array( $key )
            )
		),
        'fields'    => array(
            array(
        		'name' => __( 'Addthis ID', 'kutetheme' ),
        		'desc' => __( 'Setting id addthis', 'kutetheme' ),
        		'id'   => 'kt_addthis_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Facebook Link', 'kutetheme' ),
        		'desc' => __( 'Setting id facebook link', 'kutetheme' ),
        		'id'   => 'kt_facebook_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Twitter', 'kutetheme' ),
        		'desc' => __( 'Your twitter username', 'kutetheme' ),
        		'id'   => 'kt_twitter_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Pinterest', 'kutetheme' ),
        		'desc' => __( 'Your pinterest username', 'kutetheme' ),
        		'id'   => 'kt_pinterest_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Dribbble', 'kutetheme' ),
        		'desc' => __( 'Your dribbble username', 'kutetheme' ),
        		'id'   => 'kt_dribbble_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Vimeo', 'kutetheme' ),
        		'desc' => __( 'Your vimeo username', 'kutetheme' ),
        		'id'   => 'kt_vimeo_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Tumblr Link', 'kutetheme' ),
        		'desc' => __( 'Your tumblr username', 'kutetheme' ),
        		'id'   => 'kt_tumblr_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Skype', 'kutetheme' ),
        		'desc' => __( 'Your skype username', 'kutetheme' ),
        		'id'   => 'kt_skype_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'LinkedIn Link', 'kutetheme' ),
        		'desc' => __( 'Setting id linkedIn link', 'kutetheme' ),
        		'id'   => 'kt_linkedIn_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Vk', 'kutetheme' ),
        		'desc' => __( 'Your vk id', 'kutetheme' ),
        		'id'   => 'kt_vk_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Google+ Link', 'kutetheme' ),
        		'desc' => __( 'Setting id Google+ link', 'kutetheme' ),
        		'id'   => 'kt_google_plus_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Google+ Link', 'kutetheme' ),
        		'desc' => __( 'Setting id Google+ link', 'kutetheme' ),
        		'id'   => 'kt_google_plus_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Youtube', 'kutetheme' ),
        		'desc' => __( 'Your youtube username', 'kutetheme' ),
        		'id'   => 'kt_youtube_link_id',
        		'type' => 'text',
        	),
            array(
        		'name' => __( 'Instagram', 'kutetheme' ),
        		'desc' => __( 'Your instagram username', 'kutetheme' ),
        		'id'   => 'kt_instagram_link_id',
        		'type' => 'text',
        	)
        )
    ),
    //CSS
    $prefix . 'stylesheet' =>  array(
        'setting' => array(
            'id'      => $prefix . 'stylesheet',
            'title'   => 'Custom JS/CS',
    		'hookup'  => false,
    		'show_on' => array(
    			// These are important, don't remove
    			'key'   => 'options-page',
    			'value' => array( $key )
            )
		),
        'fields'    => array(
            array(
        		'name' => __( 'Code CSS', 'kutetheme' ),
        		'desc' => __( 'Add css in your site', 'kutetheme' ),
        		'id'   => 'kt_add_css',
        		'type' => 'ace_editer_css',
        	),
            array(
                'name' => __( 'Code JS', 'kutetheme' ),
                'desc' => __( 'Add js in your site', 'kutetheme' ),
                'id'   => 'kt_add_js',
                'type' => 'ace_editer_js',
            )
        )
    ),
    //Infomations
    $prefix . 'infomation' =>  array(
        'setting' => array(
            'id'      => $prefix . 'infomation',
            'title'   => 'Info',
    		'hookup'  => false,
    		'show_on' => array(
    			// These are important, don't remove
    			'key'   => 'options-page',
    			'value' => array( $key )
            )
		),
        'fields'    => array(
            array(
        		'name' => __( 'Address', 'kutetheme' ),
        		'desc' => __( 'Setting address for your site', 'kutetheme' ),
        		'id'   => 'kt_address',
        		'type' => 'textarea',
        	),
            array(
        		'name' => __( 'Phone', 'kutetheme' ),
        		'desc' => __( 'Setting hotline for your site', 'kutetheme' ),
        		'id'   => 'kt_phone',
        		'type' => 'textarea',
        	),
            array(
        		'name' => __( 'Email', 'kutetheme' ),
        		'desc' => __( 'Setting email for your site', 'kutetheme' ),
        		'id'   => 'kt_email',
        		'type' => 'textarea',
        	)
        )
    )
);
return $config;