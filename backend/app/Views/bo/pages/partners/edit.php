<?php

$partner = \PropelService\PartnerQuery::create()->findOneByIntId(@$item);

if($partner===null){
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
}

$partner_options = $partner->getOptions(true);

if(isset($partner_options['services'])){
    $apps = [];
    foreach ($partner_options['services'] as $index => $app){
        $apps[$index] = [
            "status" => $app['status']
        ];
    }
}else{
    $partner_options['services'] = [];
    $apps = [];
}

?>
<style>
    .app-icon {
        font-size: 24px!important;
    }
</style>
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Edit Partner
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    <?php echo $partner->getName(); ?>
                </span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="<?=@$basePath?>/pag/partners/list" class="btn btn-default btn-bold">
                Back
            </a>
            <div class="btn-group">
                <button id="fast_save_changes" data-action="continue" type="button" class="btn btn-brand btn-bold">
                    Save Changes
                </button>
                <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="kt-nav">
                        <li class="kt-nav__item">
                            <a href="javascript:void(0)" class="kt-nav__link" data-ktwizard-type="action-submit" data-action="continue">
                                <i class="kt-nav__link-icon flaticon2-writing"></i>
                                <span class="kt-nav__link-text">Save &amp; continue</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a href="javascript:void(0)" class="kt-nav__link" data-ktwizard-type="action-submit" data-action="new">
                                <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                <span class="kt-nav__link-text">Save &amp; add new</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1" role="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_2" role="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="16" height="16" rx="2"/>
                                    <rect fill="#000000" opacity="0.3" x="9" y="9" width="6" height="6"/>
                                    <path d="M20,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,8 C22,8.55228475 21.5522847,9 21,9 L20,9 L20,7 Z" fill="#000000"/>
                                    <path d="M20,11 L21,11 C21.5522847,11 22,11.4477153 22,12 L22,12 C22,12.5522847 21.5522847,13 21,13 L20,13 L20,11 Z" fill="#000000"/>
                                    <path d="M20,15 L21,15 C21.5522847,15 22,15.4477153 22,16 L22,16 C22,16.5522847 21.5522847,17 21,17 L20,17 L20,15 Z" fill="#000000"/>
                                    <path d="M3,7 L4,7 L4,9 L3,9 C2.44771525,9 2,8.55228475 2,8 L2,8 C2,7.44771525 2.44771525,7 3,7 Z" fill="#000000"/>
                                    <path d="M3,11 L4,11 L4,13 L3,13 C2.44771525,13 2,12.5522847 2,12 L2,12 C2,11.4477153 2.44771525,11 3,11 Z" fill="#000000"/>
                                    <path d="M3,15 L4,15 L4,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,16 C2,15.4477153 2.44771525,15 3,15 Z" fill="#000000"/>
                                </g>
                            </svg>
                            Services
                        </a>
                    </li>
                    <?php
    
                    foreach ($partner_options['services'] as $index => $value){
        
                        if(isset($value['status']) && $value['status'] == 'enabled'){
                            $app_code = $index;
                            $app_code = str_replace('-', '_', $app_code);
            
                            $file_template = '../app/Views/bo/services/'.strtoupper($app_code);
                            if(file_exists($file_template.'.php')){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_<?=$app_code?>" role="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M10.8226874,8.36941377 L12.7324324,9.82298668 C13.4112512,8.93113547 14.4592942,8.4 15.6,8.4 C17.5882251,8.4 19.2,10.0117749 19.2,12 C19.2,13.9882251 17.5882251,15.6 15.6,15.6 C14.5814697,15.6 13.6363389,15.1780547 12.9574041,14.4447676 L11.1963369,16.075302 C12.2923051,17.2590082 13.8596186,18 15.6,18 C18.9137085,18 21.6,15.3137085 21.6,12 C21.6,8.6862915 18.9137085,6 15.6,6 C13.6507856,6 11.9186648,6.9294879 10.8226874,8.36941377 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M8.4,18 C5.0862915,18 2.4,15.3137085 2.4,12 C2.4,8.6862915 5.0862915,6 8.4,6 C11.7137085,6 14.4,8.6862915 14.4,12 C14.4,15.3137085 11.7137085,18 8.4,18 Z" fill="#000000"/>
                                </g>
                            </svg>
                            <?=str_replace("_", "", strtoupper($app_code))?>
                        </a>
                    </li>
                    <?php
                            }
                        }
        
                    }
    
                    ?>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="" method="post" enctype="multipart/form-data" id="kt_form">
                <input type="hidden" name="opType" value="1027" />
                <input type="hidden" name="internalId" value="<?php echo $partner->getIntId(); ?>" />
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Partner Details:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name="partnerName" class="form-control" type="text" value="<?php echo $partner->getName(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Code</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name="partnerCode" class="form-control" type="text" value="<?php echo $partner->getCode(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Logo</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input name="partnerLogo" class="form-control" type="text" value="<?php echo $partner->getLogo(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Structure</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="partnerStructure" class="form-control">
                                                    <?php
                                                    
                                                    $subStructure = \PropelService\StructureQuery::create()->getAlTreeStructure(false, $session['structure']);
                                                    $htmlSelector = \PropelService\StructureQuery::create()->selectorOptions($subStructure, '', $partner->getCode());
                                                    
                                                    echo $htmlSelector;
                                                    
                                                    ?>
                                                </select>
                                                <script>
                                                    let actualStructure = '<?php echo $partner->getStructure() ?>';
                                                    $('select[name="partnerStructure"] > option').each(function(){
                                                        if($(this).attr('value') == actualStructure){
                                                            $(this).prop('selected', true);
                                                        }else{
                                                            $(this).prop('selected', false);
                                                        }
                                                    })
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h3 class="kt-section__title kt-section__title-sm">Partner Options:</h3>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <span class="kt-switch">
                                                        <label>
                                                            <input name="partnerStatus" type="checkbox" <?php if($partner->getStatus() === \PropelService\Map\PartnerTableMap::COL_STATUS_ENABLED) echo 'checked="checked"'; ?>>
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <?php
    
                    foreach ($partner_options['services'] as $index => $value){
        
                        if(isset($value['status']) && $value['status'] == 'enabled'){
                            $app_code = $index;
                            $app_code = str_replace('-', '_', $app_code);
            
                            $file_template = '../app/Views/bo/services/'.strtoupper($app_code);
                            if(file_exists($file_template.'.php')){
                    ?>
                    <div class="tab-pane " id="kt_user_edit_tab_<?=$app_code?>" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                        <?php
                                echo view('bo/services/'.strtoupper($app_code), [
                                    "options" => $value['options']
                                ]);
                    ?>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
        
                    }
    
                    ?>
                    <div class="tab-pane " id="kt_user_edit_tab_2" role="tabpanel">
                        <div class="kt-widget31" id="list_services">
                        
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: Content -->
<script>
    const AppsInstalled = JSON.parse(`<?php echo json_encode($apps); ?>`);
    
    // Base elements
    var formEl;
    formEl = $('#kt_form');
    var validator;

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                //= Step 1
                partnerName: {
                    required: true
                },
                partnerCode: {
                    required: true
                }
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var btn = $('a[data-ktwizard-type="action-submit"], #fast_save_changes');

    btn.on('click', function(e) {
        let action = $(this).attr('data-action');
        e.preventDefault();

        if (validator.form()) {
            // See: src\js\framework\base\app.js
            KTApp.progress(btn);
            //KTApp.block(formEl);

            // See: http://malsup.com/jquery/form/#ajaxSubmit
            formEl.ajaxSubmit({
                url: '<?=@$as?>',
                headers: {
                    'Authorization': '<?=@$session['token']?>'
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if(response.resultCode === 0){
                        swal.fire({
                            "title": "",
                            "text": "The partner has been successfully submitted!",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        }).then(function(){
                            if(action === 'new'){
                                window.location='<?=@$basePath?>/pag/partners/add';
                            }
                        });
                    }else{
                        swal.fire({
                            "title": "",
                            "text": response.responseInfo,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                    KTApp.unprogress(btn);
                    //KTApp.unblock(formEl);
                }
            });
        }
    });

    $(document).off('keyup', 'input[name="partnerName"]');
    $(document).on('keyup', 'input[name="partnerName"]', function(e){
        let string = $(this).val().replace(/ /g, '-');
        $('input[name="partnerCode"]').val(string.toLowerCase());
    });
    
    function appsList(){
        var form = new FormData();
        form.append('opType', 4000);
        $.ajax({
            url: '<?=@$as?>',
            method: "POST",
            headers: {
                'Authorization': '<?=@$session['token']?>'
            },
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(result){
                if(result.resultCode === 0){
                    $('#list_services').empty();
                    $.each(result.responseInfo, function(i,v){
                        let typeApp = '';
                        if(v.type == 'application'){
                            typeApp = '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Application</span>';
                        }else if(v.type == 'widget'){
                            typeApp = '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-primary">Widget</span>';
                        }else if(v.type == 'api'){
                            typeApp = '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-dark">Api</span>';
                        }
                        $('#list_services').append((i!==0?'<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit"></div>':'')+'<div class="kt-widget31__item">\n' +
                            '                                <div class="kt-widget31__content">\n' +
                            '                                    <div class="kt-widget31__pic">\n' +
                            '                                        <div class="kt-badge kt-badge--xl kt-badge--warning app-icon">'+v.icon+'</div>\t\n' +
                            '                                    </div>\n' +
                            '                                    <div class="kt-widget31__info">\n' +
                            '                                        <a href="#" class="kt-widget31__username">\n' +
                            '                                            '+v.title+'\n' +
                            '                                        </a>\n' +
                            '                                        <p class="kt-widget31__text">\n' +
                            '                                            '+v.description+'\n' +
                            '                                        </p>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                                <div class="kt-widget31__content">\n' +
                            '                                    <div class="kt-widget31__progress">'+typeApp+'</div>\n' +
                            '                                    '+(typeof AppsInstalled[v.code] !== 'undefined' && AppsInstalled[v.code].status === 'enabled' ? '<a href="javascript:void(0);" onclick="uninstallApp(\''+v.code+'\')" class="btn-danger btn btn-sm btn-bold">Uninstall</a>' : '<a href="javascript:void(0);" onclick="installApp(\''+v.code+'\')" class="btn-brand btn btn-sm btn-bold">Install</a>')+'\n' +
                            '                                </div>\n' +
                            '                            </div>')
                    });
                }
            },
            error: function(er){}
        });
    }

    function installApp(code){
        KTApp.blockPage();
        var form = new FormData();
        form.append('opType', 4001);
        form.append('internalId', '<?=$partner->getIntId()?>');
        form.append('appCode', code);
        $.ajax({
            url: '<?=@$as?>',
            method: "POST",
            headers: {
                'Authorization': '<?=@$session['token']?>'
            },
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(result){
                KTApp.unblockPage();
                let response = result;
                if(response.resultCode === 0){
                    swal.fire({
                        "title": "",
                        "text": "Application has been installed.",
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary"
                    }).then(function(){
                        window.location.reload();
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": response.responseInfo,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            },
            error: function(er){KTApp.unblockPage();}
        });
    }

    function uninstallApp(code){
        KTApp.blockPage();
        var form = new FormData();
        form.append('opType', 4002);
        form.append('internalId', '<?=$partner->getIntId()?>');
        form.append('appCode', code);
        $.ajax({
            url: '<?=@$as?>',
            method: "POST",
            headers: {
                'Authorization': '<?=@$session['token']?>'
            },
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(result){
                KTApp.unblockPage();
                let response = result;
                if(response.resultCode === 0){
                    swal.fire({
                        "title": "",
                        "text": "Application has been uninstalled.",
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary"
                    }).then(function(){
                        window.location.reload();
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": response.responseInfo,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            },
            error: function(er){KTApp.unblockPage();}
        });
    }

    initValidation();
    appsList();
</script>