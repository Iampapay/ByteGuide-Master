jQuery(function () {

    var baseUrl = window.location.origin + '/cineteq';

    var currentUrl = window.location.href;
    var urlParts = currentUrl.split('/').slice(-2);
    var lastTwoParts = urlParts[0] + "/" + urlParts[1];

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* function for add batch slot details into database */
    $(document).on('click', '#addCentreBtn', function () {
        $("#centreRegForm").validate({
            rules: {
                centre_name: {
                    required: true
                },
                house_no: {
                    required: true
                },
                street: {
                    required: true
                },
                post_office: {
                    required: true
                },
                police_station: {
                    required: true
                },
                state: {
                    required: true
                },
                dist: {
                    required: true
                },
                block: {
                    required: true
                },
                pin_code: {
                    required: true, digits: true, minlength: 6, maxlength: 6
                },
                mob_no: {
                    required: true, digits: true, minlength: 10, maxlength: 10
                },
                email_id: {
                    required: true,
                    email: true
                },
                lat: {
                    required: true
                },
                long: {
                    required: true
                },
                spos_name: {
                    required: true
                },
                spos_mob: {
                    required: true, digits: true, minlength: 10, maxlength: 10
                },
                spos_email: {
                    required: true,
                    email: true
                }
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/add-training-centre",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#centreRegForm")[0].reset();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        })
    })

    /* function for fetch batch slot details into database */
    let batch_slotTable;
    function fetchBatchSlotDetailsAdmin() {
        if ($.fn.DataTable.isDataTable("#batch_slotTable")) {
            batch_slotTable.clear().destroy();
        }
        batch_slotTable = $('#batch_slotTable').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "desc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                // processing: '<img style="width:50px; height:50px;" src="{{ asset("public/img/img_logo.png") }}" />',
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<i class="fa fa-clipboard" aria-hidden="true"></i> <h4 class="text-success">Copied %d rows to clipboard<h4>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [10, 25, 50, 100, 5000],
                [10, 25, 50, 100, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/fetch-slot",
                type: "GET",
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
                },
            },
            columns: [
                { data: 'id' },
                { data: 'start_time' },
                { data: 'end_time' },
                { data: 'action' },
            ]
        });
        batch_slotTable.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (lastTwoParts == 'admin/batch-slot') {
        fetchBatchSlotDetailsAdmin();
    }

    /* function for add batch slot details into database */
    $(document).on('click', '#addSlotBtn', function () {
        $("#batchSlotForm").validate({
            rules: {
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                }
            },
            messages: {
                start_time: {
                    required: "Please enter starting time"
                },
                end_time: {
                    required: "Please enter ending time"
                }
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/add-slot",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#batchSlotForm")[0].reset();
                            fetchBatchSlotDetailsAdmin();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        })
    })

    $(document).on('click', '#Edit-Batch-Slot-Btn', function (e) {
        var edit_id = $(this).data('e_id');
        $(".addBatchSlot").css("display", "none");
        $(".editBatchSlot").removeAttr("style");
        $.ajax({
            type: "POST",
            url: baseUrl + "/admin/edit-slot",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                edit_id: edit_id
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $('#editslotForm').find('input').val('');
                    $('#u_id').val(response.batchslot_details.id)
                    $('#edit_start_time').val(response.batchslot_details.start_time);
                    $('#edit_end_time').val(response.batchslot_details.end_time);
                } else {
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.closeDuration = 200;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.options.progressBar = true;
                    toastr.error(response.message);
                }
            }
        });
    })

    $(document).on('click', '#Batch-slot-cancelEdit', function (e) {
        $(".editBatchSlot").css("display", "none");
        $(".addBatchSlot").removeAttr("style");
    })

    $(document).on('click', '#batch_slot_update', function () {
        $("#editslotForm").validate({
            rules: {
                update_start_time: {
                    required: true
                },
                update_end_time: {
                    required: true
                },
            },
            messages: {
                update_start_time: {
                    required: "Please enter start time"
                },
                update_end_time: {
                    required: "Please enter end time"
                },
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/update-slot",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#editslotForm")[0].reset();
                            fetchBatchSlotDetailsAdmin();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                            $(".editBatchSlot").css("display", "none");
                            $(".addBatchSlot").removeAttr("style");
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        });
    });

    $(document).on('click', '#delete-Batch-Slot-Btn', function () {
        var delete_id = $(this).data('d_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            id: delete_id
                        },
                        url: baseUrl + "/admin/delete-slot",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                $("#editslotForm")[0].reset();
                                $(".editBatchSlot").css("display", "none");
                                $(".addBatchSlot").removeAttr("style");
                                fetchBatchSlotDetailsAdmin();
                            } else {
                                swal(response.message);
                            }
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                    });
                    swal("Deleted!", "Your data has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            }
        );
    });

    /* function for add employeer details into database */
    $(document).on('click', '#addEmployeerBtn', function () {
        $("#employeerForm").validate({
            rules: {
                comp_name: {
                    required: true
                },
                comp_address: {
                    required: true
                }
            },
            messages: {
                comp_name: {
                    required: "Please enter company name"
                },
                comp_address: {
                    required: "Please enter company address"
                }
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/add-employeer",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#employeerForm")[0].reset();
                            fetchEmployeerDetailsAdmin();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        })
    })

    let employeerTable;
    function fetchEmployeerDetailsAdmin() {
        if ($.fn.DataTable.isDataTable("#employeerTable")) {
            employeerTable.clear().destroy();
        }
        employeerTable = $('#employeerTable').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "desc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                // processing: '<img style="width:50px; height:50px;" src="{{ asset("public/img/img_logo.png") }}" />',
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<i class="fa fa-clipboard" aria-hidden="true"></i> <h4 class="text-success">Copied %d rows to clipboard<h4>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [10, 25, 50, 100, 5000],
                [10, 25, 50, 100, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/fetch-employeer",
                type: "GET",
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
                },
            },
            columns: [
                { data: 'id' },
                { data: 'comp_name' },
                { data: 'comp_address' },
                {
                    data: 'comp_logo',
                    render: function (data) {
                        if(data == 'null') {
                            return '<p>Not Available</p>';
                        } else {
                            return '<img src="' + baseUrl + '/public/company-Logo/' + data + '" width="50px" height="40px"/>';
                        }
                    }
                },
                { data: 'action' },
            ]
        });
        employeerTable.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (lastTwoParts == 'admin/employeer') {
        fetchEmployeerDetailsAdmin();
    }

    $(document).on('click', '#EditemployeeBtn', function (e) {
        var edit_id = $(this).data('e_id');
        $(".addEmployeer").css("display", "none");
        $(".editEmployeer").removeAttr("style");
        $.ajax({
            type: "POST",
            url: baseUrl + "/admin/edit-employeer",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                edit_id: edit_id
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $('#editEmployeerForm').find('input').val('');
                    $('#u_id').val(response.employeer_details.id)
                    $('#Edit_cName').val(response.employeer_details.comp_name);
                    $('#Edit_cAddress').val(response.employeer_details.comp_address);
                    $('#Edit_cLogo').val(response.employeer_details.comp_logo);
                } else {
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.closeDuration = 200;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.options.progressBar = true;
                    toastr.error(response.message);
                }
            }
        });
    })

    $(document).on('click', '#EmployeercancelEdit', function (e) {
        $(".editEmployeer").css("display", "none");
        $(".addEmployeer").removeAttr("style");
    })

    $(document).on('click', '#updateEmployeerBtn', function () {
        $("#editEmployeerForm").validate({
            rules: {
                comp_name: {
                    required: true
                },
                comp_address: {
                    required: true
                }
            },
            messages: {
                comp_name: {
                    required: "Please enter company name"
                },
                comp_address: {
                    required: "Please enter company address"
                }

            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/update-employeer",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#editEmployeerForm")[0].reset();
                            fetchEmployeerDetailsAdmin();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                            $(".editEmployeer").css("display", "none");
                            $(".addEmployeer").removeAttr("style");
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        });
    });

    $(document).on('click', '#deleteEmployeeBtn', function () {
        var delete_id = $(this).data('d_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            id: delete_id
                        },
                        url: baseUrl + "/admin/delete-employeer",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                $("#editEmployeerForm")[0].reset();
                                $(".editEmployeer").css("display", "none");
                                $(".addEmployeer").removeAttr("style");
                                fetchEmployeerDetailsAdmin();
                            } else {
                                swal(response.message);
                            }
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                    });
                    swal("Deleted!", "Your data has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            }
        );
    });

    /* function for add placement details into database */
    $(document).on('click', '#AddPlacementBtn', function () {
        $("#placementForm").validate({
            rules: {
                employeer: {
                    required: true
                },
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                experience: {
                    required: true
                },
                location: {
                    required: true
                }
            },
            messages: {
                employeer: {
                    required: "Please select employeer"
                },
                title: {
                    required: "Please enter job title"
                },
                description: {
                    required: "Please enter job description"
                },
                experience: {
                    required: "Please enter experience needed"
                },
                location: {
                    required: "Please enter preferred location"
                }
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/add-placement",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#placementForm")[0].reset();
                            fetchPlacementDetailsAdmin();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        })
    })

    /* function for fetch placement details */
    let PlacementTable;
    function fetchPlacementDetailsAdmin() {
        if ($.fn.DataTable.isDataTable("#PlacementTable")) {
            PlacementTable.clear().destroy();
        }
        PlacementTable = $('#PlacementTable').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "desc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                // processing: '<img style="width:50px; height:50px;" src="{{ asset("public/img/img_logo.png") }}" />',
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<i class="fa fa-clipboard" aria-hidden="true"></i> <h4 class="text-success">Copied %d rows to clipboard<h4>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [10, 25, 50, 100, 5000],
                [10, 25, 50, 100, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/fetch-placement",
                type: "GET",
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
                },
            },
            columns: [
                { data: 'id' },
                { data: 'comp_name' },
                {
                    data: 'comp_logo',
                    render: function (data) {
                        if(data == 'null') {
                            return '<p>Not Available</p>';
                        } else {
                            return '<img src="' + baseUrl + '/public/company-Logo/' + data + '" width="50px" height="40px"/>';
                        }
                    }
                },
                { data: 'job_title' },
                { data: 'job_desc' },
                { data: 'job_exp' },
                { data: 'job_loc' },
                { data: 'action' },
            ]
        });
        PlacementTable.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (lastTwoParts == 'admin/placement') {
        fetchPlacementDetailsAdmin();
    }

    /* function for edit placement details */
    $(document).on('click', '#editPlacementBtn', function (e) {
        var edit_id = $(this).data('e_id');
        $(".addPlacement").css("display", "none");
        $(".editPlacement").removeAttr("style");
        $.ajax({
            type: "POST",
            url: baseUrl + "/admin/edit-placement",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                edit_id: edit_id
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $('#EditplacementForm').find('input').val('');
                    $('#u_id').val(response.placement_details.id)
                    $('#edit_empl').val(response.placement_details.employeer_id);
                    $('#edit_jTitle').val(response.placement_details.job_title);
                    $('#edit_jDescription').val(response.placement_details.job_desc);
                    $('#edit_jExperience').val(response.placement_details.job_exp);
                    $('#edit_jLocation').val(response.placement_details.job_loc);
                } else {
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.closeDuration = 200;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.options.progressBar = true;
                    toastr.error(response.message);
                }
            }
        });
    })

    /* function for cancle edit option */
    $(document).on('click', '#cancelEdit', function (e) {
        $(".editPlacement").css("display", "none");
        $(".addPlacement").removeAttr("style");
    })

    /* function for update placement details into database */
    $(document).on('click', '#updatePlacementBtn', function () {
        $("#EditplacementForm").validate({
            rules: {
                update_employeer: {
                    required: true
                },
                update_title: {
                    required: true
                },
                update_description: {
                    required: true
                },
                update_experience: {
                    required: true
                },
                update_location: {
                    required: true
                }
            },
            messages: {
                update_employeer: {
                    required: "Please select employeer"
                },
                update_title: {
                    required: "Please enter job title"
                },
                update_description: {
                    required: "Please enter job description"
                },
                update_experience: {
                    required: "Please enter experience needed"
                },
                update_location: {
                    required: "Please enter preferred location"
                }
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/update-placement",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#EditplacementForm")[0].reset();
                            fetchPlacementDetailsAdmin();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                            $(".editPlacement").css("display", "none");
                            $(".addPlacement").removeAttr("style");
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        });
    });

    /* function for delete placement details from database */
    $(document).on('click', '#deletePlacementBtn', function () {
        var delete_id = $(this).data('d_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            id: delete_id
                        },
                        url: baseUrl + "/admin/delete-placement",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                $("#EditplacementForm")[0].reset();
                                $(".editPlacement").css("display", "none");
                                $(".addPlacement").removeAttr("style");
                                fetchPlacementDetailsAdmin();
                            } else {
                                swal(response.message);
                            }
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                    });
                    swal("Deleted!", "Your data has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            }
        );
    });

    $(document).on('change', '#selectedCentre', function (e) {
        var centre_id = $("#selectedCentre").val();
        if (centre_id == ''){
            $("#selectedCentre").css("border-color", "red");
            $("#centreValidation").css("display", "");
        } else {
            $("#selectedCentre").css("border-color", "");
            $("#centreValidation").css("display", "none");
        }
    });

    $(document).on('click', '#searchBatchBtn', function (e) {
        var centre_id = $("#selectedCentre").val();
        if (centre_id == ''){
            $("#selectedCentre").css("border-color", "red");
            $("#centreValidation").css("display", "");
        } else {
            $("#selectedCentre").css("border-color", "");
            $("#centreValidation").css("display", "none");
            if (urlParts[0] == 'trainee-placement') {
                // var placementID = urlParts[1];
                var placementID = $("#plcID").val();
                searchedBatch(centre_id,placementID);
            }
        }
    })

    let traineeBatchList;
    function searchedBatch(centre_id,placementID) {
        if ($.fn.DataTable.isDataTable("#traineeBatchTbl")) {
            traineeBatchList.clear().destroy();
        }
        traineeBatchList = $('#traineeBatchTbl').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "asc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<h1 class="text-success">Copied %d rows to clipboard<h1>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/search-batch",
                type: "GET",
                data: {
                    centre_id: centre_id,
                    placementID: placementID
                },
                datatype: "json",
                complete: function (res) {
                    if (res.responseJSON.recordsTotal > 0) {
                        $('.batchList').css("display", "");
                    } else {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.options.closeDuration = 200;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.options.closeMethod = 'slideUp';
                        toastr.options.progressBar = true;
                        toastr.error('No Records Found');
                        $('.batchList').css("display", "none");
                    }
                },
            },
            columns: [
                { data: 'id' },
                { data: 'batch_code' },
                { data: 'start_date' },
                { data: 'ten_ass_date' },
                { data: 'course_code' },
                { data: 'status' },
                { data: 'action' },
            ]
        });
        traineeBatchList.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (urlParts[0] == 'batch') {
        var batch_id = $("#batchID").val();
        var place_id = $("#placeID").val();
        assessedTraineeList(batch_id, place_id);
    }

    let AssessedTraineeList;
    function assessedTraineeList(batch_id,place_id) {
        if ($.fn.DataTable.isDataTable("#AssessedTraineeListTbl")) {
            AssessedTraineeList.clear().destroy();
        }
        AssessedTraineeList = $('#AssessedTraineeListTbl').DataTable({
            // dom: 'Blfrtip',
            ordering: true,
            order: [[0, "asc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<h1 class="text-success">Copied %d rows to clipboard<h1>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/assessed-trainee-list",
                type: "GET",
                data: {
                    batch_id: batch_id,
                    place_id: place_id
                },
                datatype: "json",
                complete: function (res) {
                },
            },
            columns: [
                { data: 'id' },
                { data: 's_f_name' },
                { data: 'trainee_code' },
                { data: 'pri_mbl_no' },
                { data: 'dob' },
                { data: 'status' },
                { data: 'action' },
            ]
        });
    }

    $(document).on('change', '#chooseCentre', function (e) {
        var centre_id = $("#chooseCentre").val();
        if (centre_id == ''){
            $("#chooseCentre").css("border-color", "red");
            $("#centreValidation").css("display", "");
        } else {
            $("#chooseCentre").css("border-color", "");
            $("#centreValidation").css("display", "none");
        }
    });

    $(document).on('click', '#searchStudentBtn', function (e) {
        var cen_id = $("#chooseCentre").val();
        if (cen_id == ''){
            $("#chooseCentre").css("border-color", "red");
            $("#centreValidation").css("display", "");
        } else {
            $("#chooseCentre").css("border-color", "");
            $("#centreValidation").css("display", "none");
            if (lastTwoParts == 'admin/view-trainee-list') {
                searchedStudents(cen_id);
            }
        }
    })

    let traineeList;
    function searchedStudents(cen_id) {
        if ($.fn.DataTable.isDataTable("#traineeDataTbl")) {
            traineeList.clear().destroy();
        }
        traineeList = $('#traineeDataTbl').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "asc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<h1 class="text-success">Copied %d rows to clipboard<h1>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/fetch-trainee-list",
                type: "GET",
                data: {
                    c_id: cen_id
                },
                datatype: "json",
                complete: function (res) {
                    if (res.responseJSON.recordsTotal > 0) {
                        $('.traineeList').css("display", "");
                    } else {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.options.closeDuration = 200;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.options.closeMethod = 'slideUp';
                        toastr.options.progressBar = true;
                        toastr.error('No Records Found');
                        $('.traineeList').css("display", "none");
                    }
                },
            },
            columns: [
                { data: 'id' },
                { data: 's_f_name' },
                { data: 'email_id' },
                { data: 'pri_mbl_no' },
                { data: 'aadhaar_no' },
                { data: 'dob' },
            ]
        });
        traineeList.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    $(document).on('change', '#selectedPlace', function (e) {
        var placement_id = $("#selectedPlace").val();
        if (placement_id == ''){
            $("#selectedPlace").css("border-color", "red");
            $("#placementValidation").css("display", "");
        } else {
            $("#selectedPlace").css("border-color", "");
            $("#placementValidation").css("display", "none");
        }
    });

    $(document).on('click', '#searchInterestStudBtn', function (e) {
        var place_id = $("#selectedPlace").val();
        if (place_id == ''){
            $("#selectedPlace").css("border-color", "red");
            $("#placementValidation").css("display", "");
        } else {
            $("#selectedPlace").css("border-color", "");
            $("#placementValidation").css("display", "none");
            if (lastTwoParts == 'admin/interested-student') {
                searchInterestStudents(place_id);
            }
        }
    })

    let interestedStudentTable;
    function searchInterestStudents(place_id) {
        if ($.fn.DataTable.isDataTable("#interestedStudTbl")) {
            interestedStudentTable.clear().destroy();
        }
        interestedStudentTable = $('#interestedStudTbl').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "asc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<h1 class="text-success">Copied %d rows to clipboard<h1>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/fetch-interested-student",
                type: "GET",
                data: {
                    place_id: place_id
                },
                datatype: "json",
                complete: function (res) {
                    console.log(res);
                    if (res.responseJSON.recordsTotal > 0) {
                        $('.IntStud').css("display", "");
                    } else {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.options.closeDuration = 200;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.options.closeMethod = 'slideUp';
                        toastr.options.progressBar = true;
                        toastr.error('No Records Found');
                        $('.IntStud').css("display", "none");
                    }
                },
            },
            columns: [
                { data: 'id' },
                { data: 'job_title' },
                { data: 'job_loc' },
                { data: 'email' },
                { data: 'phone' },
            ]
        });
        interestedStudentTable.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    /* function for add batch slot details into database */
    $(document).on('click', '#searchMatchedBatch', function () {
        if ($("#sector").val() == '' && $("#course").val() == '' && $("#district").val() == '' && $("#training-partner").val() == '' && $("#training-centre").val() == '' && $("#batch-type").val() == '' && $("#batch-status").val() == ''){
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-right';
            toastr.options.closeDuration = 200;
            toastr.options.showMethod = 'slideDown';
            toastr.options.hideMethod = 'slideUp';
            toastr.options.closeMethod = 'slideUp';
            toastr.options.progressBar = true;
            toastr.error('Nothing to search');
        } else {
            if (lastTwoParts == 'admin/batch-approval') {
                var formData = {
                    "sector": $("#sector").val(),
                    "course": $("#course").val(),
                    "district": $("#district").val(),
                    "training_partner": $("#training-partner").val(),
                    "training_centre": $("#training-centre").val(),
                    "batch_type": $("#batch-type").val(),
                    "batch_status": $("#batch-status").val()
                };
                searchMatchedBatchs(formData);
            }
        }
    })

    let matchedBatchTable;
    function searchMatchedBatchs(formData) {
        if ($.fn.DataTable.isDataTable("#matchedBatchTable")) {
            matchedBatchTable.clear().destroy();
        }
        matchedBatchTable = $('#matchedBatchTable').DataTable({
            // dom: 'Blfrtip',
            ordering: true,
            order: [[0, "asc"]],
            searching: false,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
            },
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/search-batch-details",
                type: "GET",
                data: formData,
                datatype: "json",
                complete: function (res) {
                    console.log(res);
                    if (res.responseJSON.recordsTotal > 0) {
                        $('#matchedBatch').css("display", "");
                    } else {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.options.closeDuration = 200;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.options.closeMethod = 'slideUp';
                        toastr.options.progressBar = true;
                        toastr.error('No Records Found');
                        $('.matchedBatch').css("display", "none");
                    }
                },
            },
            columns: [
                { data: 'id' },
                { data: 'centre_details' },
                { data: 'batch_details' },
                { data: 'status' },
                { data: 'action' },
            ]
        });
    }

    //send approve request
    $(document).on('click', '#approveBatchBtn', function () {
        var btc_id = $(this).data('btc_id');
        var btc_req = 'app';
        swal({
            title: "Are you sure?",
            text: "Do you want to approve the batch !",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            btc_id: btc_id,
                            btc_req: btc_req
                        },
                        url: baseUrl + "/admin/permission-request",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                swal(response.message);
                                searchMatchedBatchs();
                            } else {
                                swal(response.message);
                            }
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                    });
                    swal("Send!", "Request has been sent", "success");
                } else {
                    swal("Cancelled", "Request has not been sent", "error");
                }
            }
        );
    });

    //send reject request
    $(document).on('click', '#rejectBatchBtn', function () {
        var btc_id = $(this).data('btc_id');
        var btc_req = 'rej';
        swal({
            title: "Are you sure?",
            text: "Do you want to reject the batch !",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: {
                            btc_id: btc_id,
                            btc_req: btc_req
                        },
                        url: baseUrl + "/admin/permission-request",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                swal(response.message);
                                searchMatchedBatchs();
                            } else {
                                swal(response.message);
                            }
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                    });
                    swal("Send!", "Request has been sent", "success");
                } else {
                    swal("Cancelled", "Request has not been sent", "error");
                }
            }
        );
    });

    /* function for import excel into database */
    $(document).on('click', '#importExcelBtn', function () {
        $("#importExcel").validate({
            rules: {
                import_student: {
                    required: true
                }
            },
            messages: {
                import_student: {
                    required: "Please select a file"
                }
            },
            highlight: function (element) {
                $(element).addClass('errorClass');
            },
            unhighlight: function (element) {
                $(element).removeClass('errorClass');
            },
            submitHandler: function (form) {
                var formData = new FormData($(form)[0]);

                $.ajax({
                    type: 'POST',
                    url: baseUrl + "/admin/import-student-details",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (response.status == true) {
                            $("#importExcel")[0].reset();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                        } else {
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    },
                });
            }
        })
    })

    if (urlParts[0] == 'view-batch-details') {
        var btch_id = urlParts[1];
        batchMonitoringList(btch_id);
    }


    function batchMonitoringList(btch_id) {
        if ($.fn.DataTable.isDataTable("#batchMonitoringDetailsTable")) {
            batchMonitorigTable.clear().destroy();
        }
        batchMonitorigTable = $('#batchMonitoringDetailsTable').DataTable({
            dom: 'Blfrtip',
            ordering: true,
            order: [[0, "asc"]],
            searching: true,
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: 'Next <i class="fa fa-caret-right"></i>',
                    previous: '<i class="fa fa-caret-left"></i> Previous',
                },
                infoFiltered: "",
                buttons: {
                    copyTitle:
                        '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
                    copyKeys: "Copy to clipboard",
                    copySuccess: {
                        _: '<h1 class="text-success">Copied %d rows to clipboard<h1>',
                        1: "1 row copy",
                    },
                },
            },
            bDestroy: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    className: "btn buttons-copy buttons-html5 btn-default",
                    titleAttr: "Copy",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    className: "btn buttons-csv buttons-html5 btn-default",
                    titleAttr: "CSV",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    className: "btn buttons-pdf buttons-html5 btn-default ml-2",
                    titleAttr: "Print",
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
            ],
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/admin/batch-monitoring-list",
                type: "POST",
                data: {
                    btch_id: btch_id
                },
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
                },
            },
            columns: [
                { data: 'id' },
                { data: 's_f_name' },
                { data: 'in_time' },
                { data: 'out_time' },
                { data: 'pri_mbl_no' },
                { data: 'email_id' },
            ]
        });
        batchMonitorigTable.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

})
