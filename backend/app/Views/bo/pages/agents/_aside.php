<!--Begin:: App Aside-->
<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
    
    <!--begin:: Widgets/Applications/User/Profile1-->
    <div class="kt-portlet ">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
            
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit-y">
            
            <!--begin::Widget -->
            <div class="kt-widget kt-widget--user-profile-1">
                <div class="kt-widget__head">
                    <div class="kt-widget__media">
                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>
                    </div>
                    <div class="kt-widget__content">
                        <div class="kt-widget__section">
                            <a href="javascript:void(0)" class="kt-widget__username">
                                <?php echo ($agent->getFullname() === null ? 'Unset name' : $agent->getFullname()); ?>
                            </a>
                            <span class="kt-widget__subtitle">
                                        <?php echo $agent->getType(); ?>
                                    </span>
                        </div>
                        <div class="kt-widget__action">
                            <button type="button" class="btn btn-success btn-sm"><?php echo $agent->getStatus(); ?></button>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__body">
                    <div class="kt-widget__content">
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Email:</span>
                            <a href="#" class="kt-widget__data"><?php echo $agent->getEmail(); ?></a>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Last Ip Address:</span>
                            <a href="#" class="kt-widget__data"><?php echo $agent->getLastAddress(); ?></a>
                        </div>
                        <div class="kt-widget__info">
                            <span class="kt-widget__label">Location:</span>
                            <span class="kt-widget__data"><?php echo $getCountry; ?></span>
                        </div>
                    </div>
                    <div class="kt-widget__items">
                        <a href="<?=@$basePath?>/pag/agents/edit/<?php echo $agent->getIntId(); ?>" class="kt-widget__item <?php if(@$actual_subpage == 'edit') {echo 'kt-widget__item--active';} ?>">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                </span>
                                <span class="kt-widget__desc">
                                    Account details
                                </span>
                            </span>
                        </a>
                        <a href="<?=@$basePath?>/pag/agents/sessions/<?php echo $agent->getIntId(); ?>" class="kt-widget__item <?php if(@$actual_subpage == 'sessions') {echo 'kt-widget__item--active';} ?>">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M19,11 L20,11 C21.6568542,11 23,12.3431458 23,14 C23,15.6568542 21.6568542,17 20,17 L19,17 L19,20 C19,21.1045695 18.1045695,22 17,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,17 L5,17 C6.65685425,17 8,15.6568542 8,14 C8,12.3431458 6.65685425,11 5,11 L3,11 L3,8 C3,6.8954305 3.8954305,6 5,6 L8,6 L8,5 C8,3.34314575 9.34314575,2 11,2 C12.6568542,2 14,3.34314575 14,5 L14,6 L17,6 C18.1045695,6 19,6.8954305 19,8 L19,11 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="kt-widget__desc">
                                    Sessions details
                                </span>
                            </span>
                        </a>
                        <a href="<?=@$basePath?>/pag/agents/securities/<?php echo $agent->getIntId(); ?>" class="kt-widget__item <?php if(@$actual_subpage == 'securities') {echo 'kt-widget__item--active';} ?>">
                            <span class="kt-widget__section">
                                <span class="kt-widget__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <polygon fill="#000000" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                                            <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" fill="#000000" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="kt-widget__desc">
                                    Security Options
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!--end::Widget -->
        </div>
    </div>
    
    <!--end:: Widgets/Applications/User/Profile1-->
</div>

<!--End:: App Aside-->