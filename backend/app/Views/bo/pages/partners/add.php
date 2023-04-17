<!--begin::Page Custom Styles(used by this page) -->
<link href="/assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Add Partner
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    Enter partner details and submit
                </span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="<?=@$basePath?>/pag/partners/list" class="btn btn-default btn-bold">
                Back
            </a>
        </div>
    </div>
</div>
<!-- end:: Content Head -->
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white" id="kt_projects_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v1__nav">
                        <div class="kt-wizard-v1__nav-items">

                            <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        Partner Details
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v1__nav-body">
                                    <div class="kt-wizard-v1__nav-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--xl">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-wizard-v1__nav-label">
                                        Review and Submit
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

                    <!--begin: Form Wizard Form-->
                    <form class="kt-form" method="post" enctype="multipart/form-data" id="kt_projects_add_form">
                        <input type="hidden" name="opType" value="1026" />

                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-heading kt-heading--md">Partner Details:</div>
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Name <span class="text-danger font-weight-bold">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input name="partnerName" class="form-control" type="text" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Code <span class="text-danger font-weight-bold">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input name="partnerCode" class="form-control" type="text" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Logo</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input name="partnerLogo" class="form-control" type="text" value="">
                                                        <span class="form-text text-muted">External link only. Ex: https://skin.demo/logo.png</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Status <span class="text-danger font-weight-bold">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <?php
                                                        $valueSet = \PropelService\Map\AdminTableMap::getValueSet(\PropelService\Map\AdminTableMap::COL_STATUS);
                                                        ?>
                                                        <select name="partnerStatus" class="form-control">
                                                            <?php
                                                            foreach ($valueSet as $index => $value){
                                                                echo '<option value="'.$value.'">'.$value.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Structure <span class="text-danger font-weight-bold">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <select name="partnerStructure" class="form-control">
                                                            <?php
                                                            
                                                            $subStructure = \PropelService\StructureQuery::create()->getAlTreeStructure(false, $session['structure']);
                                                            $htmlSelector = \PropelService\StructureQuery::create()->selectorOptions($subStructure);
                                                            
                                                            echo $htmlSelector;
                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Step 1-->

                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Review your Details and Submit</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v1__review">
                                    <div class="kt-wizard-v1__review-item">
                                        <div class="kt-wizard-v1__review-title">
                                            Partner Details
                                        </div>
                                        <div class="kt-wizard-v1__review-content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Step 2-->

                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                Previous
                            </div>
                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                Submit
                            </div>
                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                Next Step
                            </div>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content -->
<script>
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;

    formEl = $('#kt_projects_add_form');

    $('#kt_projects_add_form .form-control').on('keyup', function(e){
        $('.kt-wizard-v1__review-content').html('Partner name: '+$('input[name="partnerName"]').val()+"<br />Agent structure: "+$('select[name="partnerStructure"] > option:selected').html()+"<br />Status: "+$('select[name="partnerStatus"] > option:selected').html())
    });

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_projects_add', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        });

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    };

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                // Step 1
                partnerName: {
                    required: true
                },
                partnerCode: {
                    required: true
                },
                partnerStatus: {
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
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    };

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                KTApp.progress(btn);
                formEl.ajaxSubmit({
                    url: '<?=@$as?>',
                    headers: {
                        'Authorization': '<?=@$session['token']?>'
                    },
                    success: function(response, status, xhr, $form) {
                        let message = JSON.parse(response);
                        KTApp.unprogress(btn);
                        if(typeof message.resultCode !== 'undefined' && message.resultCode === 0){
                            swal.fire({
                                "title": "",
                                "text": "The partner has been successfully submitted!",
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            }).then((result) => {
                                window.location='<?=@$basePath?>/pag/partners/edit/'+message.responseInfo.PartnerId;
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": message.responseInfo,
                                "type": "error",
                                "buttonStyling": false,
                                "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                            });
                        }
                    }
                });
            }
        });
    };
    
    $(document).off('keyup', 'input[name="partnerName"]');
    $(document).on('keyup', 'input[name="partnerName"]', function(e){
        let string = $(this).val().replace(/ /g, '-');
        $('input[name="partnerCode"]').val(string.toLowerCase());
    });

    var initAvatar = function() {
        avatar = new KTAvatar('kt_projects_add_avatar');
    };

    initWizard();
    initValidation();
    initSubmit();
    initAvatar();
</script>