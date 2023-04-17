<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
     data-ktmenu-dropdown-timeout="500">
    <ul class="kt-menu__nav ">
        <li class="kt-menu__item <?php if(@$page == 'dashboard' || @$page == '') echo 'kt-menu__item--here'; ?>" aria-haspopup="true">
            <a href="<?=@$basePath?>" class="kt-menu__link ">
                <span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
					    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						    <polygon points="0 0 24 0 24 24 0 24"/>
							<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
							<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                </span>
                <span class="kt-menu__link-text">Dashboard</span>
            </a>
        </li>
        <li class="kt-menu__section ">
            <h4 class="kt-menu__section-text">Management</h4>
            <i class="kt-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu <?php if(@$page == 'structures' && @$subpage == 'list' || @$page == 'structures' && @$subpage == 'add' || @$page == 'structures' && @$subpage == 'edit') echo 'kt-menu__item--open kt-menu__item--here'; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" x="4" y="16" width="4" height="4" rx="1"/>
                            <rect fill="#000000" x="4" y="10" width="4" height="4" rx="1"/>
                            <rect fill="#000000" x="10" y="16" width="4" height="4" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="10" width="4" height="4" rx="1"/>
                            <rect fill="#000000" x="4" y="4" width="4" height="4" rx="1"/>
                            <rect fill="#000000" x="16" y="16" width="4" height="4" rx="1"/>
                        </g>
                    </svg>
                </span>
                <span class="kt-menu__link-text">Structures</span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu ">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                    <li class="kt-menu__item <?php if(@$page == 'structures' && @$subpage == 'list') echo 'kt-menu__item--active'; ?>" aria-haspopup="true"><a href="<?=@$basePath?>/pag/structures/list" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List</span></a></li>
                    <li class="kt-menu__item <?php if(@$page == 'structures' && @$subpage == 'add') echo 'kt-menu__item--active'; ?>" aria-haspopup="true"><a href="<?=@$basePath?>/pag/structures/add" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add new</span></a></li>
                </ul>
            </div>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu <?php if(@$page == 'agents' && @$subpage == 'list' || @$page == 'agents' && @$subpage == 'add' || @$page == 'agents' && @$subpage == 'edit') echo 'kt-menu__item--open kt-menu__item--here'; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                </span>
                <span class="kt-menu__link-text">Agents</span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu ">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                    <li class="kt-menu__item <?php if(@$page == 'agents' && @$subpage == 'list') echo 'kt-menu__item--active'; ?>" aria-haspopup="true"><a href="<?=@$basePath?>/pag/agents/list" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List</span></a></li>
                    <li class="kt-menu__item <?php if(@$page == 'agents' && @$subpage == 'add') echo 'kt-menu__item--active'; ?>" aria-haspopup="true"><a href="<?=@$basePath?>/pag/agents/add" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add new</span></a></li>
                </ul>
            </div>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu <?php if(@$page == 'partners' && @$subpage == 'list' || @$page == 'partners' && @$subpage == 'add' || @$page == 'partners' && @$subpage == 'edit') echo 'kt-menu__item--open kt-menu__item--here'; ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon fill="#000000" opacity="0.3" points="5 3 19 3 23 8 1 8"/>
                            <polygon fill="#000000" points="23 8 12 20 1 8"/>
                        </g>
                    </svg>
                </span>
                <span class="kt-menu__link-text">Partners</span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu ">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                    <li class="kt-menu__item <?php if(@$page == 'partners' && @$subpage == 'list') echo 'kt-menu__item--active'; ?>" aria-haspopup="true"><a href="<?=@$basePath?>/pag/partners/list" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List</span></a></li>
                    <li class="kt-menu__item <?php if(@$page == 'partners' && @$subpage == 'add') echo 'kt-menu__item--active'; ?>" aria-haspopup="true"><a href="<?=@$basePath?>/pag/partners/add" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add new</span></a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>