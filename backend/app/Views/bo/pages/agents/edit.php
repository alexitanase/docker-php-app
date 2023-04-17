<?php

use GeoIp2\Database\Reader;

$agent = \PropelService\AdminQuery::create()->findOneByIntId(@$item);

if($agent===null){
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
}

try {
    // Creates the API reader object
    $reader = new Reader('../GeoLite2-City.mmdb');
    
    // Get information from the IP address
    $record = $reader->city($agent->getLastAddress());
    $getCountry = $record->country->name;
}catch (Exception $e){
    $getCountry = 'Undefined';
}

?>
<style>
    .kt-badge.kt-badge--lg {
        width: 90px;
        height: 90px;
        font-size: 24px;
    }
    .kt-widget.kt-widget--user-profile-1 .kt-widget__head .kt-widget__content .kt-widget__section .kt-widget__username {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 92%;
        display: inline-block;
    }
</style>
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Edit Agent
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    <?php echo ($agent->getFullname() === null ? $agent->getEmail() : $agent->getFullname()); ?>
                </span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="<?=@$basePath?>/pag/agents/list" class="btn btn-default btn-bold">
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

    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>

        <!--End:: App Aside Mobile Toggle-->

        <?php echo view('bo/pages/agents/_aside', [
            "agent"            => $agent,
            "basePath"         => $basePath,
            "getCountry"       => $getCountry,
            "actual_subpage"   => @$actual_subpage
        ]); ?>

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Account details <small>update account details</small></h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                
                                </div>
                            </div>
                        </div>
                        <form method="post" enctype="multipart/form-data" class="kt-form kt-form--label-right" id="kt_form">
                            <input type="hidden" name="opType" value="1012" />
                            <input type="hidden" name="internalId" value="<?=$agent->getIntId()?>" />
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Agent details:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Fullname</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" name="agentFullname" type="text" value="<?=($agent->getFullname()!==null?$agent->getFullname():'')?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" name="agentPhoneNumber" type="text" value="<?=($agent->getPhonenumber()!==null?$agent->getPhonenumber():'')?>">
                                                <span class="form-text text-muted">Try to always specify the prefix of your country, ex: +34600700800.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email <span class="text-danger font-weight-bold">*</span></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="email" readonly value="<?=$agent->getEmail()?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Agent Type <span class="text-danger font-weight-bold">*</span></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <?php
                                                $valueSet = \PropelService\Map\AdminTableMap::getValueSet(\PropelService\Map\AdminTableMap::COL_TYPE);
                                                ?>
                                                <select name="agentType" class="form-control">
                                                    <?php
                                                        foreach ($valueSet as $index => $value){
                                                            echo '<option value="'.$value.'" '.($agent->getType() == $value ? 'selected' : '').'>'.$value.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Status <span class="text-danger font-weight-bold">*</span></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <?php
                                                $valueSet = \PropelService\Map\AdminTableMap::getValueSet(\PropelService\Map\AdminTableMap::COL_STATUS);
                                                ?>
                                                <select name="agentStatus" class="form-control">
                                                    <?php
                                                    foreach ($valueSet as $index => $value){
                                                        echo '<option value="'.$value.'" '.($agent->getStatus() == $value ? 'selected' : '').'>'.$value.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Structure <span class="text-danger font-weight-bold">*</span></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="agentStructure" class="form-control">
                                                    <?php
                
                                                    $subStructure = \PropelService\StructureQuery::create()->getAlTreeStructure(false, $session['structure']);
                                                    $htmlSelector = \PropelService\StructureQuery::create()->selectorOptions($subStructure);
                
                                                    echo $htmlSelector;
                
                                                    ?>
                                                </select>
                                                <script>
                                                    let actualStructure = '<?php echo $agent->getStructure() ?>';
                                                    $('select[name="agentStructure"] > option').each(function(){
                                                        if($(this).attr('value') == actualStructure){
                                                            $(this).prop('selected', true);
                                                        }else{
                                                            $(this).prop('selected', false);
                                                        }
                                                    })
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Change password:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">New password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" name="agentPassword" type="password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Confirm password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" name="agentPasswordConf" type="password" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-success" data-action="">Submit</button>&nbsp;
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--End:: App Content-->
    </div>

    <!--End::App-->
</div>
<script>
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
                agentFullname: {
                    required: false
                },
                agentType: {
                    required: true
                },
                agentStatus: {
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

    var btn = $('button[type="submit"], a[data-ktwizard-type="action-submit"], #fast_save_changes');

    btn.on('click', function(e) {
        let action = $(this).attr('data-action');
        if(typeof action !== 'undefined') action = '';
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
                            "text": "The agent has been successfully submitted!",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        }).then(function(){
                            if(action === 'new'){
                                window.location='<?=@$basePath?>/pag/agents/add';
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

    initValidation();
</script>