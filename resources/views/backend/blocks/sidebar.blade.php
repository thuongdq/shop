<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html"
                      method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>

            @php
            $home = [
                    'icon' => 'icon-home',
                    'name' => 'Trang chủ',
                    'url' => route('admin.dashboard.index'),
                ];
            $users = [
                    'icon' => 'icon-user',
                    'name' => 'Thành viên',
                    'url' => 'javascript:;',
                    'child' => [
                        0 => [
                            'icon' => 'icon-users',
                            'name' => 'Tất cả người dùng',
                            'url' => route('admin.user.index')
                            ],
                        1 => [
                            'icon' => 'icon-user-follow',
                            'name' => 'Thêm mới',
                            'url' => route('admin.user.create')
                            ],
                        2 => [
                            'icon' => 'icon-user-following',
                            'name' => 'Hồ sơ của bạn',
                            'url' => route('admin.user.profile')
                            ]
                    ]
                ];

            $categories_menu = [
                    'icon' => 'icon-layers',
                    'name' => 'Chuyên mục',
                    'url' => 'javascript:;',
                    'child' => [
                        0 => [
                            'icon' => 'icon-list',
                            'name' => 'Tất cả chuyên mục',
                            'url' => route('admin.category.index')
                            ],
                        1 => [
                            'icon' => 'icon-plus',
                            'name' => 'Thêm mới',
                            'url' => route('admin.category.create')
                            ]
                    ]
                ];
               foreach ($categories_all[0] as $key => $category){
                   $categories_menu['child'][] = [
                                'icon' => 'icon-list',
                                'name' => $category->name,
                                'url' => route('admin.category.show', ['id'=>$category->id])
                            ];
               }
            $products = [
                    'icon' => 'icon-layers',
                    'name' => 'Sản phẩm',
                    'url' => 'javascript:;',
                    'child' => [
                        0 => [
                            'icon' => 'icon-list',
                            'name' => 'Danh sách sản phẩm',
                            'url' => route('admin.product.index')
                            ],
                        1 => [
                            'icon' => 'icon-plus',
                            'name' => 'Thêm mới',
                            'url' => route('admin.product.create')
                            ]
                    ]
                ];
            $menu = [ $home, $users, $categories_menu,$products];
            @endphp

            @forelse($menu as $key => $item)
                @php
                $active = '';
                $view_child = '';
                $item['url'] == url()->current() ? $active = 'active open' : '';
                if(isset($item['child']) && !empty($item['child'])){
                    $view_child .= '<ul class="sub-menu">';
                    foreach ($item['child'] as $key_child => $item_child){
                        if( $item_child['url'] == url()->current()){
                            $active_child = $active = 'active open';
                        }else{
                            $active_child = '';
                        }

                        $view_child .= '
                            <li class="nav-item '.$active_child.'">
                                <a href="'.$item_child['url'].'" class="nav-link ">
                                    <i class="'.$item_child['icon'].'"></i>
                                    <span class="title">'.$item_child['name'].'</span>
                                </a>
                            </li>
                        ';
                    }
                    $view_child .= '</ul>';
                }
                @endphp

                <li class="nav-item start {{ $active }}">
                    <a href="{{ $item['url'] }}" class="nav-link nav-toggle">
                        <i class="{{ $item['icon'] }}"></i>
                        <span class="title">{{ $item['name'] }}</span>
                        @if(isset($item['child']) && !empty($item['child']))
                            <span class="arrow"></span>
                            <span class="selected"></span>
                        @endif
                    </a>
                    <?php echo $view_child; ?>
                </li>
            @empty
            @endforelse

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->