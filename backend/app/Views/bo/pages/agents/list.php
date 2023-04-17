<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Agents
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    0 Total
                </span>
                <form class="kt-margin-l-20" id="kt_subheader_search_form">
                    <div class="kt-input-icon kt-input-icon--right kt-subheader__search">
                        <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>

                                <!--<i class="flaticon2-search-1"></i>-->
                            </span>
                        </span>
                    </div>
                </form>
            </div>
            <div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
                <div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
                <div class="btn-toolbar kt-margin-l-20">
                    <div class="dropdown" id="kt_subheader_group_actions_status_change">
                        <button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                            Update Status
                        </button>
                        <div class="dropdown-menu">
                            <ul class="kt-nav">
                                <li class="kt-nav__section kt-nav__section--first">
                                    <span class="kt-nav__section-text">Change status to:</span>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link" data-toggle="status-change" data-status="ENABLED">
                                        <span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">Enabled</span></span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link" data-toggle="status-change" data-status="DISABLED">
                                        <span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--bold">Disabled</span></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button style="display: none;" class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">
                        Fetch Selected
                    </button>
                    <button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_delete_all">
                        Delete All
                    </button>
                </div>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="<?=@$basePath?>/pag/agents/add" class="btn btn-label-brand btn-bold">
                Add Agent
            </a>
        </div>
    </div>
</div>

<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="flaticon-tool"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Agents table
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-4">

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Structure</label>
                            <div class="col-lg-9 col-xl-9">
                                <select name="filterByStructure" class="form-control">
                                    <option value="all" selected>ALL</option>
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
                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit" style="margin: 0px;"></div>
            </div>

            <!--begin: Datatable -->
            <div class="kt-datatable" id="kt_agents_list_datatable"></div>

            <!--end: Datatable -->
        </div>
    </div>

    <!--end::Portlet-->

    <!--begin::Modal-->
    <div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="kt-scroll" data-scroll="true" data-height="200">
                        <ul id="kt_apps_user_fetch_records_selected"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
</div>

<!-- end:: Content -->
<script>
    // variables
    var datatable;

    // init
    var init = function () {
        // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
        datatable = $('#kt_agents_list_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'post',
                        params: {
                            opType: 1010,
                            structure: $('select[name="filterByStructure"]').val()
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
                    field: "Email",
                    title: "Identification",
                    width: 200,
                    // callback function support for column rendering
                    template: function (data, i) {
                        var number = 4 + i;
                        while (number > 12) {
                            number = number - 3;
                        }

                        var output = '';
                        var stateNo = KTUtil.getRandomInt(0, 6);
                        var states = [
                            'success',
                            'brand',
                            'danger',
                            'success',
                            'warning',
                            'primary',
                            'info'
                        ];
                        var state = states[0];

                        output = '' +
                            '<div class="kt-user-card-v2">' +
                            '<div class="kt-user-card-v2__pic">' +
                            '<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.Email.substring(0, 1) + '</div>' +
                            '</div>' +
                            '<div class="kt-user-card-v2__details">' +
                            '<a href="<?=@$basePath?>/pag/agents/edit/'+data.IntId+'" class="kt-user-card-v2__name">' + data.Email + '</a>' +
                            '<span class="kt-user-card-v2__desc">' + (data.Fullname === null ? 'Unset name' : data.Fullname) + '</span>' +
                            '</div>' +
                            '</div>';
                        

                        return output;
                    }
                },
                {
                    field: 'Structure',
                    title: 'Structure',
                    // callback function support for column rendering
                    template: function (row) {
                        return (row.Structure === '' ? 'OWNER' : row.Structure);
                    },
                },
                {
                    width: 110,
                    field: 'Status',
                    title: 'Status',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function (row) {
                        var status = {
                            "ENABLED": {'title': 'Enabled', 'state': 'success'},
                            "DISABLED": {'title': 'Disabled', 'state': 'danger'},
                        };
                        return '<span class="kt-badge kt-badge--' + status[row.Status].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.Status].state + '">' + status[row.Status].title + '</span>';
                    },
                },
                {
                    field: 'CreatedAt',
                    title: 'Date Created',
                    sortable: false,
                    template: function (row) {
                        return formatDate(row.CreatedAt, "{D}/{M}/{Y} {H}:{I}");
                    }
                },
                {
                    field: 'UpdatedAt',
                    title: 'Date Modified',
                    sortable: false,
                    type: 'date',
                    template: function (row) {
                        return formatDate(row.UpdatedAt, "{D}/{M}/{Y} {H}:{I}");
                    }
                },
                {
                    field: "Type",
                    title: "Type",
                    autoHide: false,
                    // callback function support for column rendering
                    template: function (row) {
                        var status = {
                            "UNSET": {
                                'title': 'Unset',
                                'class': ' btn-label-warning'
                            },
                            "OWNER": {
                                'title': 'Owner',
                                'class': ' btn-label-brand'
                            },
                            "PARTNER": {
                                'title': 'Partner',
                                'class': ' btn-label-danger'
                            },
                            3: {
                                'title': 'Supplier',
                                'class': ' btn-label-warning'
                            },
                            4: {
                                'title': 'Staff',
                                'class': ' btn-label-success'
                            }
                        };
                        return '<span class="btn btn-bold btn-sm btn-font-sm ' + status[row.Type].class + '">' + status[row.Type].title + '</span>';
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
                        return '<a href="<?=@$basePath?>/pag/agents/edit/'+row.IntId+'" class="btn btn-sm btn-default btn-icon btn-icon-md">' +
                            '<i class="kt-nav__link-icon flaticon2-contract"></i>' +
                            '</a>';
                    },
                }]
        });
    };

    // search
    var search = function () {
        $('#kt_form_status').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'Status');
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

    // fetch selected records
    var selectedFetch = function () {
        // event handler on selected records fetch modal launch
        $('#kt_datatable_records_fetch_modal').on('show.bs.modal', function (e) {
            // show loading dialog
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function () {
                loading.hide();
            }, 1000);

            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                return $(chk).val();
            });

            // populate selected IDs
            var c = document.createDocumentFragment();

            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }

            $(e.target).find('#kt_apps_user_fetch_records_selected').append(c);
        }).on('hide.bs.modal', function (e) {
            $(e.target).find('#kt_apps_user_fetch_records_selected').empty();
        });
    };

    // selected records status update
    var selectedStatusUpdate = function () {
        $('#kt_subheader_group_actions_status_change').on('click', "[data-toggle='status-change']", function () {
            var status = $(this).find(".kt-nav__link-text").html();
            var dataStatus = $(this).attr('data-status');

            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                return $(chk).val();
            });

            var elements = [];
            $.each(ids, function(i, v){
                elements.push(v);
            });

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to update " + ids.length + " selected records status to " + status + " ?",
                    type: "info",

                    confirmButtonText: "Yes, update!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function (result) {
                    if (result.value) {
                        var form = new FormData();
                        form.append('opType', 1013);
                        form.append('internalId', elements.join(','));
                        form.append('agentStatus', dataStatus);
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
                                    swal.fire({
                                        title: 'Updated!',
                                        text: 'Your selected records statuses have been updated!',
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    }).then(function(){
                                        datatable.search($('#generalSearch').val().toLowerCase(), 'Status');
                                    });
                                }else{
                                    swal.fire({
                                        title: 'Cancelled',
                                        text: result.responseInfo,
                                        type: 'error',
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                }
                            },
                            error: function(er){}
                        });
                    } else if (result.dismiss === 'cancel') {
                        /*swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records statuses have not been updated!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });*/
                    }
                });
            }
        });
    }

    // selected records delete
    var selectedDelete = function () {
        $('#kt_subheader_group_actions_delete_all').on('click', function () {
            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                return $(chk).val();
            });

            var elements = [];
            $.each(ids, function(i, v){
                elements.push(v);
            });

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    text: "Are you sure to delete " + ids.length + " selected records ?",
                    type: "danger",

                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-brand"
                }).then(function (result) {
                    if (result.value) {
                        var form = new FormData();
                        form.append('opType', 1014);
                        form.append('internalId', elements.join(','));
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
                                    swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your selected records has been removed!',
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    }).then(function(){
                                        datatable.search($('#generalSearch').val().toLowerCase(), 'Status');
                                    });
                                }else{
                                    swal.fire({
                                        title: 'Cancelled',
                                        text: result.responseInfo,
                                        type: 'error',
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                }
                            },
                            error: function(er){}
                        });
                    } else if (result.dismiss === 'cancel') {
                        /*swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records have not been deleted! :)',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });*/
                    }
                });
            }
        });
    }

    var updateTotal = function () {
        datatable.on('kt-datatable--on-layout-updated', function () {
            $('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
        });
    };

    $('select[name="filterByStructure"]').on('change', function(){
        console.debug("filterByStructure", $(this).val());
        datatable.destroy();
        init();
        search();
        selection();
        selectedFetch();
        selectedStatusUpdate();
        selectedDelete();
        updateTotal();
    });

    init();
    search();
    selection();
    selectedFetch();
    selectedStatusUpdate();
    selectedDelete();
    updateTotal();
</script>