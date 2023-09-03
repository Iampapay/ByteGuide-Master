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

    /* function for add student details into database */
    $(document).on('click', '#regStudentBtn', function () {
        $("#studentRegForm").validate({
            rules: {
                f_name: { required: true },
                l_name: { required: true },
                fF_name: { required: true },
                fL_name: { required: true },
                mF_name: { required: true },
                mL_name: { required: true },
                rW_guardian: { required: true },
                gender: { required: true },
                phy_challenged: { required: true },
                d_o_b: { required: true },
                pan_num: { minlength: 10, maxlength: 10 },
                aadhaar_no: { digits: true, minlength: 12, maxlength: 12 },
                ration_no: { minlength: 12, maxlength: 12 },
                voter_id: { minlength: 10, maxlength: 10 },
                birth_c_no: { minlength: 10, maxlength: 15 },
                drive_l_no: { minlength: 10, maxlength: 15 },
                pasport_no: { minlength: 12, maxlength: 12 },
                eco_status: { required: true },
                res_status: { required: true },
                kar_id: { required: true },
                house_no: { required: true },
                street_no: { required: true },
                vill_town: { required: true },
                state: { required: true },
                dist: { required: true },
                block: { required: true },
                gram_pan: { required: true },
                post_office: { required: true },
                police_stn: { required: true },
                pin_code: { required: true, digits: true, minlength: 6, maxlength: 6 },
                pri_mobile: { required: true, digits: true, minlength: 10, maxlength: 10 },
                sec_mobile: { digits: true, minlength: 10, maxlength: 10 },
                edu_qualification: { required: true },
                edu_qlf_status: { required: true },
                trng_typ: { required: true },
                sector: { required: true },
                course: { required: true },
                ifs_code: { required: true },
                bank_name: { required: true },
                branch_name: { required: true },
                acc_num: { required: true },
                acc_hold_name: { required: true },
                trainee_photo: { required: true },
                signature: { required: true },
                res_proof: { required: true },
                high_qlf_proof: { required: true },
                age_proof: { required: true },
                bank_pass: { required: true },
            },
            // messages: {
            //     f_name: {
            //         required: "Please enter First Name"
            //     },
            //     l_name: {
            //         required: "Please enter Last Name"
            //     },
            //     fF_name: {
            //         required: "Please enter Father's First Name"
            //     },
            //     fL_name: {
            //         required: "Please enter Father's Last Name"
            //     },
            //     mF_name: {
            //         required: "Please enter Mother's First Name"
            //     },
            //     mL_name: {
            //         required: "Please enter Mother's Last Name"
            //     },
            //     rW_guardian: {
            //         required: "Please enter Relationship With Guardian"
            //     },
            //     gender: {
            //         required: "Please enter Gender"
            //     },
            //     d_o_b: {
            //         required: "Please enter Date of Birth"
            //     },
            //     eco_status: {
            //         required: "Please enter Economical Status"
            //     },
            //     res_status: {
            //         required: "Please enter Residential Status"
            //     },
            //     kar_id: {
            //         required: "Please enter Karmadisha ID"
            //     }
            // },
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
                    enctype: 'multipart/form-data',
                    url: baseUrl + "/centre/add-student",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (response.status == true) {
                            $("#studentRegForm")[0].reset();
                            $("#trneePhoto").val("");
                            $("#passProof").val("");
                            $("#resProof").val("");
                            $("#HighQlfProof").val("");
                            $("#ageProof").val("");
                            $("#bankPass").val("");
                            $("#drvLic").val("");
                            $("#passProof").val("");
                            $("#rationProof").val("");
                            $("#aadhaarProof").val("");
                            $("#voterProof").val("");
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

    /* function for retrive all placement details from database to show in a datatable */
    let centrePlacementTable;
    function fetchPlacementDetailsCentre() {
        if ($.fn.DataTable.isDataTable("#centrePlacementTable")) {
            centrePlacementTable.clear().destroy();
        }
        centrePlacementTable = $('#centrePlacementTable').DataTable({
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
                url: baseUrl + "/centre/fetch-placement",
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
        centrePlacementTable.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (lastTwoParts == 'centre/placement') {
        fetchPlacementDetailsCentre();
    }

    /* function for selecting students all students at one click*/
    $(document).on('click', '#flexCheckDefault', function () {
        var isChecked = $(this).prop('checked');
        $('input.form-check-input:not(#flexCheckDefault)').prop('checked', isChecked);
    });

    /* function for validate write custom message from textarea */
    $('#customMsg').on('keyup', function () {
        var mess_age = $(this).val().trim();
        if (mess_age != '') {
            $('.error-message').hide();
            $('#customMsg').css("border-color", "");
        } else {
            $('.error-message').show();
            $('#customMsg').css("border-color", "red");
        }
    });

    /* function for add remove validation on checkbox when selecting students */
    $(document).on('click', '.selectStud', function () {
        if ($('.selectStud').is(':checked')) {
            $('.error-check').hide();
        } else {
            $('#flexCheckDefault').prop('checked', false);
            $('.error-check').show();
        }
    });

    /* function for send message of placement opportunity to each student's registered mobile number */
    $(document).on('click', '#sendWhatsAppMsg', function () {
        var message = $('#customMsg').val().trim();
        var checkbox = $('.selectStud').is(':checked');
        if (!message) {
            $('.error-message').show();
            $('#customMsg').css("border-color", "red");
        } else {
            $('.error-message').hide();
            $('#customMsg').css("border-color", "");
        }

        if (!checkbox) {
            $('.error-check').show();
        } else {
            $('.error-check').hide();
        }

        if (message && checkbox) {
            $('.error-message').hide();
            $('.error-check').hide();
            $('#customMsg').css("border-color", "");
            var jobId = $('#jobId').val();
            var selectedStudents = [];
            $('table').find('.selectStud').each(function () {
                if ($(this).is(':checked')) {
                    var s_id = $(this).val();
                    selectedStudents.push({ studID: s_id });
                }
            });

            $.ajax({
                type: "POST",
                url: baseUrl + "/centre/send-whatsapp-msg",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    base_url: baseUrl,
                    job_id: jobId,
                    msg: message,
                    stud_data: selectedStudents
                },
                success: function (response) {
                    console.log(response);
                    var successCount = 0;

                    for (var i = 0; i < response.length; i++) {
                        if (response[i].status === true) {
                            successCount++;
                        }
                    }

                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.closeDuration = 200;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'slideUp';
                    toastr.options.closeMethod = 'slideUp';
                    toastr.options.progressBar = true;

                    if (successCount > 0) {
                        toastr.success(successCount + ' message sent successfully.');
                    } else {
                        toastr.error('Could not sent message!');
                    }
                }
            });
        }
    });

    let batch_Table;
    function fetchBatchDetails() {
        if ($.fn.DataTable.isDataTable("#batch_Table")) {
            batch_Table.clear().destroy();
        }
        batch_Table = $('#batch_Table').DataTable({
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
                url: baseUrl + "/centre/centre-fetch-batch",
                type: "GET",
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
                },
            },
            columns: [
                { data: 'id' },
                { data: 'batch_name' },
                { data: 'batch_code' },
                { data: 'ass_student' },
                { data: 'status' },
                { data: 'action' },
            ]
        });
        batch_Table.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (lastTwoParts == 'centre/centre-fetch-batch-details') {
        fetchBatchDetails();
    }

    //add batch details
    $(document).on('click', '#addBatch', function () {
        $("#batchForm").validate({
            rules: {
                batch_name: {
                    required: true
                },
                batch_code: {
                    required: true
                }
            },
            messages: {
                batch_name: {
                    required: "Please enter Batch name"
                },
                batch_code: {
                    required: "Please enter Batch Code"
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
                    url: baseUrl + "/centre/centre-add-batch",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == true) {
                            $("#batchForm")[0].reset();
                            fetchBatchDetails();
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

    //edit batch details
    $(document).on('click', '#Edit-Batch-Btn', function (e) {
        var edit_id = $(this).data('e_id');
        $(".addBatch").css("display", "none");
        $(".editBatch").removeAttr("style");
        $.ajax({
            type: "POST",
            url: baseUrl + "/centre/centre-edit-batch",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                edit_id: edit_id
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $('#editBatchForm').find('input').val('');
                    $('#u_id').val(response.batch_details.id)
                    $('#edit_batch_name').val(response.batch_details.batch_name);
                    $('#edit_batch_code').val(response.batch_details.batch_code);
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

    //cancel batch details
    $(document).on('click', '#Batch-cancelEdit', function (e) {
        $(".editBatch").css("display", "none");
        $(".addBatch").removeAttr("style");
    })

    //update batch details
    $(document).on('click', '#batch_update', function () {
        $("#editBatchForm").validate({
            rules: {
                edit_batch_name: {
                    required: true
                },
                edit_batch_code: {
                    required: true
                },
            },
            messages: {
                edit_batch_name: {
                    required: "Please enter batch name"
                },
                edit_batch_code: {
                    required: "Please enter batch code"
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
                    url: baseUrl + "/centre/centre-update-batch",
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
                            $("#editBatchForm")[0].reset();
                            fetchBatchDetails();
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.closeDuration = 200;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.options.closeMethod = 'slideUp';
                            toastr.options.progressBar = true;
                            toastr.success(response.message);
                            $(".editBatch").css("display", "none");
                            $(".addBatch").removeAttr("style");
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

    //delete batch details
    $(document).on('click', '#delete-Batch-Btn', function () {
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
                        url: baseUrl + "/centre/centre-delete-batch",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                $("#editBatchForm")[0].reset();
                                $(".editBatch").css("display", "none");
                                $(".addBatch").removeAttr("style");
                                fetchBatchDetails();
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

    //send approve request
    $(document).on('click', '#send-app-reqBtn', function () {
        var batc_id = $(this).data('b_id');
        swal({
            title: "Are you sure?",
            text: "Request will be sent for approval !",
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
                            batc_id: batc_id
                        },
                        url: baseUrl + "/centre/batch-app-req",
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            if (response.status == true) {
                                swal(response.message);
                                fetchBatchDetails();
                            } else {
                                swal(response.message);
                            }
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                    });
                    swal("Deleted!", "Request has been sent", "success");
                } else {
                    swal("Cancelled", "Request has not been sent", "error");
                }
            }
        );
    });

    // let course_Table;
    // fetchCourseDetails();
    // function fetchCourseDetails() {
    //     if ($.fn.DataTable.isDataTable("#course_Table")) {
    //         course_Table.clear().destroy();
    //     }
    //     course_Table = $('#course_Table').DataTable({
    //         dom: 'Blfrtip',
    //         ordering: true,
    //         order: [[0, "desc"]],
    //         searching: true,
    //         processing: true,
    //         serverSide: true,
    //         language: {
    //             paginate: {
    //                 next: 'Next <i class="fa fa-caret-right"></i>',
    //                 previous: '<i class="fa fa-caret-left"></i> Previous',
    //             },
    //             infoFiltered: "",
    //             // processing: '<img style="width:50px; height:50px;" src="{{ asset("public/img/img_logo.png") }}" />',
    //             buttons: {
    //                 copyTitle:
    //                     '<i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>',
    //                 copyKeys: "Copy to clipboard",
    //                 copySuccess: {
    //                     _: '<i class="fa fa-clipboard" aria-hidden="true"></i> <h4 class="text-success">Copied %d rows to clipboard<h4>',
    //                     1: "1 row copy",
    //                 },
    //             },
    //         },
    //         bDestroy: true,
    //         buttons: [
    //             {
    //                 extend: "copyHtml5",
    //                 text: "Copy",
    //                 className: "btn buttons-copy buttons-html5 btn-default",
    //                 titleAttr: "Copy",
    //                 exportOptions: {
    //                     columns: [0, 1, 2, 3],
    //                 },
    //             },
    //             {
    //                 extend: "csvHtml5",
    //                 text: "CSV",
    //                 className: "btn buttons-csv buttons-html5 btn-default",
    //                 titleAttr: "CSV",
    //                 exportOptions: {
    //                     columns: [0, 1, 2, 3],
    //                 },
    //             },
    //             {
    //                 extend: "print",
    //                 text: "Print",
    //                 className: "btn buttons-pdf buttons-html5 btn-default ml-2",
    //                 titleAttr: "Print",
    //                 exportOptions: {
    //                     columns: [0, 1, 2, 3],
    //                 },
    //             },
    //         ],
    //         lengthMenu: [
    //             [10, 25, 50, 100, 5000],
    //             [10, 25, 50, 100, "All"],
    //         ],
    //         ajax: {
    //             url: baseUrl + "/centre/centre-fetch-course",
    //             type: "GET",
    //             datatype: "json",
    //             complete: function (res) {
    //                 // console.log(res);
    //             },
    //         },
    //         columns: [
    //             { data: 'id' },
    //             { data: 'name' },
    //             { data: 'academic_session_id' },
    //             { data: 'fees' },
    //             { data: 'fees_adv' },
    //             { data: 'status' },
    //             { data: 'action' },
    //         ]
    //     });
    //     course_Table.buttons().container().appendTo("#printbar");
    //     $(".dt-buttons").addClass("float-right btn-group");
    //     $(".buttons-copy").css("background", "#319cda");
    //     $(".buttons-csv").css("background", "#319cda");
    //     $(".buttons-pdf").css("background", "#319cda");
    // }

    // $(document).on('click', '#addCourse', function () {
    //     $("#courseForm").validate({
    //         rules: {
    //             course_name: {
    //                 required: true
    //             },
    //             academic_session_id: {
    //                 required: true
    //             },
    //             fees: {
    //                 required: true
    //             },
    //             fees_adv: {
    //                 required: true
    //             },
    //             status: {
    //                 required: true
    //             },
    //         },
    //         messages: {
    //             course_name: {
    //                 required: "Please enter Course name"
    //             },
    //             academic_session_id: {
    //                 required: "Please enter Academic session Id"
    //             },
    //             fees: {
    //                 required: "Please enter course fees"
    //             },
    //             fees_adv: {
    //                 required: "Please enter course fees advance"
    //             },
    //             status: {
    //                 required: "Please enter status field"
    //             },
    //         },
    //         highlight: function (element) {
    //             $(element).addClass('errorClass');
    //         },
    //         unhighlight: function (element) {
    //             $(element).removeClass('errorClass');
    //         },
    //         submitHandler: function (form) {
    //             var formData = new FormData($(form)[0]);

    //             $.ajax({
    //                 type: 'POST',
    //                 url: baseUrl + "/centre/centre-add-course",
    //                 data: formData,
    //                 dataType: 'json',
    //                 cache: false,
    //                 contentType: false,
    //                 processData: false,
    //                 success: function (response) {
    //                     // console.log(response);
    //                     if (response.status == true) {
    //                         $("#courseForm")[0].reset();
    //                         fetchCourseDetails();
    //                         toastr.options.closeButton = true;
    //                         toastr.options.positionClass = 'toast-top-right';
    //                         toastr.options.closeDuration = 200;
    //                         toastr.options.showMethod = 'slideDown';
    //                         toastr.options.hideMethod = 'slideUp';
    //                         toastr.options.closeMethod = 'slideUp';
    //                         toastr.options.progressBar = true;
    //                         toastr.success(response.message);
    //                     } else {
    //                         toastr.options.closeButton = true;
    //                         toastr.options.positionClass = 'toast-top-right';
    //                         toastr.options.closeDuration = 200;
    //                         toastr.options.showMethod = 'slideDown';
    //                         toastr.options.hideMethod = 'slideUp';
    //                         toastr.options.closeMethod = 'slideUp';
    //                         toastr.options.progressBar = true;
    //                         toastr.error(response.message);
    //                     }
    //                 },
    //                 error: function (error) {
    //                     console.log(error.responseText);
    //                 },
    //             });
    //         }
    //     })
    // })

    // $(document).on('click', '#Edit-Course-Btn', function (e) {
    //     var edit_id = $(this).data('e_id');
    //     $(".addCourse").css("display", "none");
    //     $(".editCourse").removeAttr("style");
    //     $.ajax({
    //         type: "POST",
    //         url: baseUrl + "/centre/centre-edit-course",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             edit_id: edit_id
    //         },
    //         success: function (response) {
    //             // console.log(response);
    //             if (response.status == true) {
    //                 $('#editCourseForm').find('input').val('');
    //                 $('#u_id').val(response.course_details.id)
    //                 $('#edit_course_name').val(response.course_details.name);
    //                 $('#edit_academic_session_id').val(response.course_details.academic_session_id);
    //                 $('#edit_fees').val(response.course_details.fees);
    //                 $('#edit_fees_adv').val(response.course_details.fees_adv);
    //                 $('#edit_status').val(response.course_details.status);


    //             } else {
    //                 toastr.options.closeButton = true;
    //                 toastr.options.positionClass = 'toast-top-right';
    //                 toastr.options.closeDuration = 200;
    //                 toastr.options.showMethod = 'slideDown';
    //                 toastr.options.hideMethod = 'slideUp';
    //                 toastr.options.closeMethod = 'slideUp';
    //                 toastr.options.progressBar = true;
    //                 toastr.error(response.message);
    //             }
    //         }
    //     });
    // })

    // $(document).on('click', '#Course_update', function () {
    //     $("#editCourseForm").validate({
    //         rules: {
    //             edit_course_name: {
    //                 required: true
    //             },
    //             edit_academic_session_id: {
    //                 required: true
    //             },
    //             edit_fees: {
    //                 required: true
    //             },
    //             edit_fees_adv: {
    //                 required: true
    //             },
    //             edit_status: {
    //                 required: true
    //             },
    //         },
    //         messages: {
    //             edit_course_name: {
    //                 required: "Please enter course name"
    //             },
    //             edit_academic_session_id: {
    //                 required: "Please enter academic session id"
    //             },
    //             edit_fees: {
    //                 required: "Please enter fees"
    //             },
    //             edit_fees_adv: {
    //                 required: "Please enter fees advance"
    //             },
    //             edit_status: {
    //                 required: "Please enter status"
    //             },
    //         },
    //         highlight: function (element) {
    //             $(element).addClass('errorClass');
    //         },
    //         unhighlight: function (element) {
    //             $(element).removeClass('errorClass');
    //         },
    //         submitHandler: function (form) {
    //             var formData = new FormData($(form)[0]);

    //             $.ajax({
    //                 type: 'POST',
    //                 url: baseUrl + "/centre/centre-update-course",
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
    //                         'content')
    //                 },
    //                 data: formData,
    //                 dataType: 'json',
    //                 cache: false,
    //                 contentType: false,
    //                 processData: false,
    //                 success: function (response) {
    //                     // console.log(response);
    //                     if (response.status == true) {
    //                         $("#editCourseForm")[0].reset();
    //                         fetchCourseDetails();
    //                         toastr.options.closeButton = true;
    //                         toastr.options.positionClass = 'toast-top-right';
    //                         toastr.options.closeDuration = 200;
    //                         toastr.options.showMethod = 'slideDown';
    //                         toastr.options.hideMethod = 'slideUp';
    //                         toastr.options.closeMethod = 'slideUp';
    //                         toastr.options.progressBar = true;
    //                         toastr.success(response.message);
    //                         $(".editCourse").css("display", "none");
    //                         $(".addCourse").removeAttr("style");
    //                     } else {
    //                         toastr.options.closeButton = true;
    //                         toastr.options.positionClass = 'toast-top-right';
    //                         toastr.options.closeDuration = 200;
    //                         toastr.options.showMethod = 'slideDown';
    //                         toastr.options.hideMethod = 'slideUp';
    //                         toastr.options.closeMethod = 'slideUp';
    //                         toastr.options.progressBar = true;
    //                         toastr.error(response.message);
    //                     }
    //                 },
    //                 error: function (error) {
    //                     console.log(error.responseText);
    //                 },
    //             });
    //         }
    //     });
    // });

    // $(document).on('click', '#delete-Course-Btn', function () {
    //     var delete_id = $(this).data('d_id');
    //     swal({
    //         title: "Are you sure?",
    //         text: "You will not be able to recover this data!",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonClass: "btn-danger",
    //         confirmButtonText: "Yes, delete it!",
    //         cancelButtonText: "No, cancel plx!",
    //         closeOnConfirm: false,
    //         closeOnCancel: false
    //     },
    //         function (isConfirm) {
    //             if (isConfirm) {
    //                 $.ajax({
    //                     type: 'POST',
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
    //                             'content')
    //                     },
    //                     data: {
    //                         id: delete_id
    //                     },
    //                     url: baseUrl + "/centre/centre-delete-course",
    //                     dataType: 'json',
    //                     success: function (response) {
    //                         // console.log(response);
    //                         if (response.status == true) {
    //                             $("#editCourseForm")[0].reset();
    //                             $(".editCourse").css("display", "none");
    //                             $(".addCourse").removeAttr("style");
    //                             fetchCourseDetails();
    //                         } else {
    //                             swal(response.message);
    //                         }
    //                     },
    //                     error: function (error) {
    //                         console.log(error.responseText);
    //                     },
    //                 });
    //                 swal("Deleted!", "Your data has been deleted.", "success");
    //             } else {
    //                 swal("Cancelled", "Your data is safe :)", "error");
    //             }
    //         }
    //     );
    // });

    /* function for view student list under a particular batch */
    $(document).on('change', '#selectedBatch', function () {
        var batch_id = $(this).val();
        if (batch_id == 0) {
            $('.showStudList').css("display", "none");
        } else {
            if (urlParts[0] == 'show-placement-details') {
                fetchStudentUnderBatch(batch_id);
            }
        }
    });

    let studentlist;
    function fetchStudentUnderBatch(batch_id) {
        if ($.fn.DataTable.isDataTable("#StudentListDataTable")) {
            studentlist.clear().destroy();
        }
        studentlist = $('#StudentListDataTable').DataTable({
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
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/centre/fetch-student-under-batch",
                type: "GET",
                data: {
                    batch_id: batch_id
                },
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
                    if (res.responseJSON.recordsTotal > 0) {
                        $('.showStudList').css("display", "");
                    } else {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.options.closeDuration = 200;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.options.closeMethod = 'slideUp';
                        toastr.options.progressBar = true;
                        toastr.error('No Records Found');
                        $('.showStudList').css("display", "none");
                    }
                    if (res.responseJSON.draw > 1) {
                        $('#flexCheckDefault').prop('checked', false);
                    }
                },
            },
            columns: [
                { data: 'select' },
                { data: 's_name' },
                { data: 'email' },
                { data: 'phone' },
            ]
        });
    }

    let StudListToSendMsg;
    function fetchStudentToAssign() {
        if ($.fn.DataTable.isDataTable("#studListToAssingBatch")) {
            StudListToSendMsg.clear().destroy();
        }
        StudListToSendMsg = $('#studListToAssingBatch').DataTable({
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
            lengthMenu: [
                [5, 10, 15, 20, 5000],
                [5, 10, 15, 20, "All"],
            ],
            ajax: {
                url: baseUrl + "/centre/fetch-student-assign-batch",
                type: "GET",
                datatype: "json",
                complete: function (res) {
                    // console.log(res.responseJSON.draw);
                    if (res.responseJSON.draw > 1) {
                        $('#flexCheckDefault').prop('checked', false);
                    }
                },
            },
            columns: [
                { data: 'select' },
                { data: 's_name' },
                { data: 'email' },
                { data: 'phone' },
            ]
        });
    }

    if (urlParts[0] == 'show-student-list') {
        fetchStudentToAssign();
    }

    $(document).on('click', '#assignBatchBtn', function () {
        var batch_id = $('#batchID').val();
        var checkbox = $('.selectStud').is(':checked');

        if (!checkbox) {
            $('.error-check').show();
        } else {
            $('.error-check').hide();
        }

        if (batch_id && checkbox) {
            $('.error-check').hide();
            var selectedStudents = [];
            $('table').find('.selectStud').each(function () {
                if ($(this).is(':checked')) {
                    var s_id = $(this).val();
                    selectedStudents.push({ studID: s_id });
                }
            });

            $.ajax({
                type: "POST",
                url: baseUrl + "/centre/assign-batch",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    batch_id: batch_id,
                    stud_data: selectedStudents
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        fetchStudentToAssign();
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
                }
            });
        }
    });

    let regStudentList;
    function fetchRegStudent() {
        if ($.fn.DataTable.isDataTable("#studListTable")) {
            regStudentList.clear().destroy();
        }
        regStudentList = $('#studListTable').DataTable({
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
                url: baseUrl + "/centre/fetch-register-student",
                type: "GET",
                datatype: "json",
                complete: function (res) {
                    // console.log(res);
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
        regStudentList.buttons().container().appendTo("#printbar");
        $(".dt-buttons").addClass("float-right btn-group");
        $(".buttons-copy").css("background", "#319cda");
        $(".buttons-csv").css("background", "#319cda");
        $(".buttons-pdf").css("background", "#319cda");
    }

    if (lastTwoParts == 'centre/view-student-list') {
        fetchRegStudent();
    }

})
