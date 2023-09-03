<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Placement Form</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap-sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="{{ asset('public/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('public/js/admin/custom.js') }}"></script>
    <style>
        body {
            background-image: url('{{ asset('public/img/feedback.webp') }}');
            width: 100%;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
        }

        .contact-form {
            background: linear-gradient(to top right, #00ffcc 0%, #cc00cc 100%);
            box-shadow: -1px -1px 10px black;
            margin-top: 8%;
            margin-bottom: 5%;
            padding: 2%;
            border-radius: 10px;
            opacity: 0.95;
        }

        .contact-form .form-control {
            border-radius: 5px;
        }

        .contact-image {
            text-align: center;
            margin-bottom: -6%;
        }

        .contact-image img {
            border-radius: 6rem;
            width: 20%;
        }

        .contact-form form {
            padding: 4%;
        }

        .contact-form h3 {
            margin-bottom: 8%;
            margin-top: -15%;
            text-align: center;
            color: whitesmoke;
        }

        .contact-form .btnContact {
            width: 100%;
            border: none;
            border-radius: 1rem;
            padding: 2%;
            background: #dc3545;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }

        .btnContactSubmit {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }

        .com_details {
            padding: 10px;
            border: 2px solid slategrey;
            margin-bottom: 17px;
        }


        .required_field {
            color: rgb(255, 0, 0);
        }

        .error {
            color: rgb(235, 0, 0) !important;
            font-weight: 500;
            font-size: 14px;
        }

        input.errorClass {
            border: 2px solid rgb(235, 0, 0) !important;
        }

        label.errorClass {
            color: 1px solid rgb(243, 10, 10) !important;
        }

        label {
            display: inline-block;
            margin-bottom: 0rem;
        }
    </style>
</head>

<body>
    <div class="container contact-form">
        <div class="contact-image">
            <a class="logo" href="https://www.cineteqservices.com/" title="STS"><img
                    src="{{ asset('public/img/img_logo.png') }}"alt="STS" /></a>
        </div>
        <form id="placement_feedback_form" autocomplete="false">
            @csrf
            <div class="row feed_form">
                <div class="col-md-8 mx-auto">
                    <div class="card mb-4 mb-md-0">
                        <div class="card-body">
                            <img class="card-img-top mb-3" src="{{ url('public/dist/img/10_header_placements.jpg') }}"
                                alt="Card image cap">
                            <div class="com_details">
                                <p class="card-text"><b>Company Name - </b>{{ $employeer_details->comp_name }}</p>
                                <p class="card-text"><b>Job Title - </b>{{ $job_details->job_title }}</p>
                                <p class="card-text"><b>Job Description - </b>{{ $job_details->job_desc }}</p>
                                <p class="card-text"><b>Job Experience - </b>{{ $job_details->job_exp }}</p>
                                <p class="card-text mb-2"><b>Location - </b>{{ $job_details->job_loc }}</p>
                            </div>
                            <input type="hidden" id="jId" value={{ $job_details->id }}>
                            <div class="form-group mb-4">
                                <input type="number" name="phone" class="form-control" id="Phone" style="border-color: darkblue;"
                                    placeholder="Your Phone Number *" autocomplete="nope" />
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" name="email" class="form-control" id="Email" style="border-color: darkblue;"
                                    placeholder="Your Email Address *" />
                            </div>
                            <div class="form-group mb-4 ml-4">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="1"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label mr-4" for="flexRadioDefault1">
                                    Interested
                                </label><br>
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="0"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Not Interested
                                </label>
                            </div>
                            <div class="form-group text-center -5px -4px 10px rgba(0, 0, 0, 0.2);">
                                <button type="submit" name="btnSubmit" class="btn btn-sm btnContact"
                                    id="submit_feedback_btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        var base_path = '{{ url(' / ') }}';
        var base_path_url = base_path.split("/").slice(0, -1).join("/");
        var base_url = base_path_url.split("/").slice(0, -1).join("/");

        $(document).on('click', '#submit_feedback_btn', function() {
            $("#placement_feedback_form").validate({
                rules: {
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    flexRadioDefault: {
                        required: true,
                    }
                },
                messages: {
                    phone: {
                        required: "Please enter Your Phone Number"
                    },
                    email: {
                        required: "Please enter Your Email Address"
                    }
                },
                highlight: function(element) {
                    $(element).addClass('errorClass');
                },
                unhighlight: function(element) {
                    $(element).removeClass('errorClass');
                },
                submitHandler: function() {
                    var formData = {
                        jid: $('#jId').val(),
                        phone: $('#Phone').val(),
                        email: $('#Email').val(),
                        interest: $('input[name="flexRadioDefault"]:checked').val(),
                    };

                    $.ajax({
                        type: 'POST',
                        url: base_url + "/submit-placement-feedback",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            if (response.status == 200) {
                                $("#placement_feedback_form")[0].reset();
                                swal("Done!", "Your data has been submitted successfully.",
                                    "success");
                            } else if (response.status == 400) {
                                swal("Sorry!!", "Your Response has already been submitted.",
                                    "error");
                            } else {
                                $("#placement_feedback_form")[0].reset();
                                swal("Sorry!!", "Please try again later.", "error");
                            }
                        },
                        error: function(error) {
                            console.log(error.responseText);
                        },
                    });
                }
            })
        })
    </script>
</body>

</html>
