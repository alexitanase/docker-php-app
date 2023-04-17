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
            "agent"        => $agent,
            "basePath"     => $basePath,
            "getCountry"   => $getCountry
        ]); ?>
        
        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Sessions details <small>list of sessions</small></h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                
                                </div>
                            </div>
                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div>
                                <!--begin: Datatable -->
                                <div class="kt-datatable" id="kt_sessions_list_datatable"></div>
                                <!--end: Datatable -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--End:: App Content-->
    </div>
    
    <!--End::App-->
</div>

<!--begin::Modal-->
<div class="modal fade" id="sessionDetailsModal" tabindex="-1" role="dialog" aria-labelledby="sessionDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionDetailsModalLabel">Session details: -</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="kt-list-timeline">
                    <div id="history_timeline_session" class="kt-list-timeline__items">
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<script>
    // variables
    var datatable;

    // init
    var init = function () {
        // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
        datatable = $('#kt_sessions_list_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'post',
                        params: {
                            opType: 1003,
                            agentId: '<?=$agent->getIntId()?>'
                        },
                        headers: {
                            'Authorization': '<?=@$session['token']?>',
                        },
                        url: '<?=@$as?>'
                    },
                },
                pageSize: 10, // display 20 records per page
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch'),
                delay: 400,
            },

            // columns definition
            columns: [
                {
                    field: 'IntId',
                    title: '#',
                    sortable: false,
                    width: 20,
                    selector: {
                        class: 'kt-checkbox--solid'
                    },
                    textAlign: 'center',
                },
                {
                    field: "Token",
                    title: "ID",
                    width: 60,
                    // callback function support for column rendering
                    template: function (data, i) {
                        let output = '' +
                            '<div class="kt-user-card-v2">' +
                            '<div class="kt-user-card-v2__details">' +
                            '<a href="javascript:void(0);" class="kt-user-card-v2__name">' + data.IntId + '</a>' +
                            '</div>' +
                            '</div>';
                        return output;
                    }
                },
                {
                    field: 'UpdatedAt',
                    title: 'Duration',
                    sortable: false,
                    template: function (row) {
                        var startTime = new Date(row.CreatedAt);
                        var endTime = new Date(row.UpdatedAt);
                        var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
                        var resultInMinutes = Math.round(difference / 60000);
                        return resultInMinutes+" min/s";
                    }
                },
                {
                    field: 'CreatedAt',
                    title: 'Date Created',
                    sortable: false,
                    type: 'date',
                    template: function (row) {
                        return formatDate(row.CreatedAt, "{D}/{M}/{Y} {H}:{I}");
                    }
                },
                {
                    field: "Actions",
                    width: 80,
                    title: "Actions",
                    sortable: false,
                    autoHide: false,
                    overflow: 'visible',
                    template: function (row) {
                        return '<a href="javascript:void(0);" data-session-id="'+row.IntId+'" class="btn btn-sm btn-default btn-icon btn-icon-md btnShowHistoryDetails">' +
                            '<i class="flaticon-eye"></i>' +
                            '</a>';
                    },
                }]
        });
    };

    // selection
    var selection = function () {
        // init form controls
        //$('#kt_form_status, #kt_form_type').selectpicker();

        // event handler on check and uncheck on records
        datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function (e) {
            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
            var count = checkedNodes.length; // selected records count

            $('#kt_subheader_group_selected_rows').html(count);

            if (count > 0) {
                $('#kt_subheader_search').addClass('kt-hidden');
                $('#kt_subheader_group_actions').removeClass('kt-hidden');
            } else {
                $('#kt_subheader_search').removeClass('kt-hidden');
                $('#kt_subheader_group_actions').addClass('kt-hidden');
            }
        });
    }

    var updateTotal = function () {
        datatable.on('kt-datatable--on-layout-updated', function () {
            $('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
        });
    };
    
    $(document).off('click', '.btnShowHistoryDetails');
    $(document).on('click', '.btnShowHistoryDetails', function(e){
        var SessionId = $(this).attr('data-session-id');
        showHistoryDetails(SessionId);
        KTApp.blockPage({
            overlayColor: '#000000',
            state: 'primary'
        });
    });
    
    var showHistoryDetails = function(sessionId){
        var form = new FormData();
        form.append('opType', 1004);
        form.append('sessionId', sessionId);
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
                    $('#history_timeline_session').empty();
                    $('#sessionDetailsModal').modal('show');
                    $('#sessionDetailsModalLabel').html('Session: '+sessionId)
                    $.each(result.responseInfo, function(i,v){
                        let affectedDetails = sessionDetailsExplode(v.Affected);
                        let badgetClass = '';
                        if(affectedDetails.type == "admin"){
                            badgetClass = 'kt-list-timeline__badge--primary';
                        }else if(affectedDetails.type == "sport"){
                            badgetClass = 'kt-list-timeline__badge--danger';
                        }else if(affectedDetails.type == "structure"){
                            badgetClass = 'kt-list-timeline__badge--success';
                        }else if(affectedDetails.type == "partner"){
                            badgetClass = 'kt-list-timeline__badge--info';
                        }
                        
                        let htmlItems = [];
                        $.each(affectedDetails.affected, function(i,v){
                            let urlType = 'javascript:void(0)';
                            if(affectedDetails.type == "admin"){
                                urlType = '<?=$basePath?>/pag/agents/edit/{$1}';
                            }else if(affectedDetails.type == "sport"){
                                urlType = '<?=$basePath?>/pag/sports/edit/{$1}';
                            }else if(affectedDetails.type == "structure"){
                                urlType = '<?=$basePath?>/pag/structures/edit/{$1}';
                            }else if(affectedDetails.type == "partner"){
                                urlType = '<?=$basePath?>/pag/partners/edit/{$1}';
                            }
                            htmlItems += ' <a href="'+urlType.replace('{$1}', v.id)+'"><span class="kt-badge kt-badge--brand kt-badge--inline">'+v.name+'</span></a> ';
                        });
                        
                        $('#history_timeline_session').append('<div class="kt-list-timeline__item">\n' +
                            '                            <span class="kt-list-timeline__badge '+badgetClass+'"></span>\n' +
                            '                            <span class="kt-list-timeline__text">'+v.ActionTitle+' '+htmlItems+'</span>\n' +
                            '                            <span class="kt-list-timeline__time">'+formatDate((parseInt(v.CreatedAt)*1000), '{D}/{M}/{Y} {H}:{I}')+'</span>\n' +
                            '                        </div>');
                    });
                    
                    if(result.responseInfo.length === 0){
                        $('#history_timeline_session').append('<div class="kt-list-timeline__item">\n' +
                            '                            <span class="kt-list-timeline__badge"></span>\n' +
                            '                            <span class="kt-list-timeline__text">There is nothing to show</span>\n' +
                            '                            <span class="kt-list-timeline__time">Just now</span>\n' +
                            '                        </div>');
                    }
                }else{
                    swal.fire({
                        title: 'Error',
                        text: result.responseInfo,
                        type: 'error',
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                    });
                }
                KTApp.unblockPage();
            },
            error: function(er){KTApp.unblockPage();}
        });
    }

    init();
    selection();
    updateTotal();
</script>