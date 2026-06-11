<?php
use App\Http\Controllers\Helper;
use App\Http\Controllers\Controller;
$controller = new Controller();
?>
@extends('layouts-side-bar.master')
@section('css')
    <!---jvectormap css-->
    <link href="{{ URL::asset('assets/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
    <!-- Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <!--Daterangepicker css-->
    <link href="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $school->name }} Profile</h4>
                        <a href="{{ route('school.allSchools') }}" class="btn text-white" style="background-color: #287C44;">
                            <i class="fas fa-school me-2"></i> All Schools
                        </a>
                    </div>

                    <div class="card-body row">
                        <div class="col-12 mb-4">
                            <div class="card p-4 shadow-sm border rounded">
                                <h4 class="mb-4 text-center">School Logo</h4>

                                <div class="p-3 border rounded bg-light">
                                    <div class="text-center mb-4">
                                        <img id="logoPreview"
                                            src="{{ $profile?->logo ? asset('storage/' . $profile->logo) : $school->logo ?? asset('assets/images/brand/uplogolight.png') }}"
                                            class="img-fluid rounded border p-2"
                                            style="max-height: 180px; object-fit: contain;" alt="School Logo">
                                    </div>

                                    <form method="POST" action="{{ route('schools.store.profile') }}"
                                        enctype="multipart/form-data" id="updateSchoolForm">
                                        @csrf
                                        @method('POST')

                                        <input type="hidden" name="school_id" value="{{ $school->id }}">

                                        <div class="form-group mb-4">
                                            <label class="form-label">Upload New Logo (optional)</label>
                                            <input type="file" name="logo" id="logoUpload" class="form-control"
                                                accept="image/*" onchange="previewLogo(event)">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="schoolName" class="form-label">School Name</label>
                                                    <input type="text" name="name" id="schoolName"
                                                        class="form-control" value="{{ $profile->name ?? $school->name }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="schoolEmail" class="form-label">Email Address</label>
                                                    <input type="email" name="email" id="schoolEmail"
                                                        class="form-control"
                                                        value="{{ $profile->email ?? $school->email }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="schoolPhone" class="form-label">Phone Number</label>
                                                    <input type="text" name="phone" id="schoolPhone"
                                                        class="form-control"
                                                        value="{{ $profile->phone ?? $school->phone }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="schoolAddress" class="form-label">Address</label>
                                                    <textarea name="address" id="schoolAddress" class="form-control" rows="3">{{ $profile->address ?? $school->address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="registrationCode" class="form-label">Registration Code</label>
                                                    <input type="text" name="registration_code" id="registrationCode"
                                                        class="form-control" value="{{ $profile->registration_code ?? $school->registration_code }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="schoolType" class="form-label">School Type</label>
                                                    <input type="text" class="form-control" value="{{ ucfirst($school->school_type ?? '') }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="registrationDate" class="form-label">Registration Date</label>
                                                    <input type="text" class="form-control" value="{{ optional($school->registration_date)->format('F j, Y') ?? '' }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">
                                                <i class="fas fa-save me-2"></i> Update School Profile Details
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <style>
                                    .form-control[type="file"] {
                                        padding: 0.2rem 0.2rem;
                                        width: 100%;
                                        font-size: 1rem;
                                        font-weight: 400;
                                        line-height: 1.5;
                                        color: #212529;
                                        background-color: #fff;
                                        border: 1px solid #ced4da;
                                        border-radius: 0.25rem;
                                        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                        display: block;
                                        height: calc(1.5em + 0.75rem + 2px);
                                        box-sizing: border-box;
                                    }

                                    @media (max-width: 575.98px) {
                                        .form-control[type="file"] {
                                            min-width: unset;
                                        }
                                    }
                                </style>
                            </div>
                        </div>
                    </div>

                    <div class="card-body row">
                        <div class="col-md-12">
                            <h4 class="text-center text-primary">{{ $school->name }} Information</h4>

                            <!-- School Info Table -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $school->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registration Code</th>
                                        <td>{{ $school->registration_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $school->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $school->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>School Type</th>
                                        <td>{{ ucfirst($school->school_type ?? '') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registration Date</th>
                                        <td>{{ optional($school->registration_date)->format('F j, Y') ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#updateSchoolForm').on('submit', function(e) {
                e.preventDefault();

                let isValid = true;
                let $form = $(this);
                let $submitBtn = $form.find('button[type="submit"]');


                $form.find('.form-control, select').removeClass('is-invalid');
                $form.find('.invalid-feedback').remove();

                // Only require school name for profile update; other fields optional
                var requiredFields = ['name'];
                requiredFields.forEach(function(field) {
                    var $el = $form.find('[name="' + field + '"]');
                    if ($el.length && !$el.val().trim()) {
                        $el.addClass('is-invalid');
                        $el.after('<div class="invalid-feedback">This field is required.</div>');
                        isValid = false;
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incomplete Form',
                        text: 'Please fill in all required fields before submitting.'
                    });
                    return;
                }


                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incomplete Form',
                        text: 'Please fill in all required fields before submitting.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to update the school profile.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData($form[0]);

                        $submitBtn.prop('disabled', true);
                        const originalBtnHtml = $submitBtn.html();
                        $submitBtn.html('Saving...<i class="fas fa-spinner fa-spin ms-2"></i>');

                        $.ajax({
                            url: '{{ route('schools.store.profile') }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Updated!',
                                    text: response.message ||
                                        'School profile updated successfully.',
                                    icon: 'success'
                                }).then((result) => {
                                    window.location.href = '{{ route('school.allSchools') }}';
                                });
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    let errorMessage = '';
                                    for (let field in errors) {
                                        errorMessage += errors[field].join('<br>') +
                                            '<br>';
                                    }
                                    Swal.fire('Validation Error', errorMessage,
                                        'error');
                                } else {
                                    Swal.fire('Error',
                                        'Something went wrong while updating. Please try again.',
                                        'error');
                                    console.error(xhr.responseText);
                                }
                            },
                            complete: function() {
                                $submitBtn.prop('disabled', false).html(
                                    originalBtnHtml);
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- JS to Preview Logo -->
    <script>
        function previewLogo(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('logoPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
@section('js')
    <!-- c3.js Charts js-->
    <script src="{{ URL::asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/charts-c3/c3-chart.js') }}"></script>
    <script src="{{ URL::asset('assets/js/charts.js') }}"></script>

    <!-- ECharts js -->
    <script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>
    <!-- Peitychart js-->
    <script src="{{ URL::asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/peitychart/peitychart.init.js') }}"></script>
    <!-- Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!--Moment js-->
    <script src="{{ URL::asset('assets/plugins/moment/moment.js') }}"></script>
    <!-- Daterangepicker js-->
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/js/daterange.js') }}"></script>
    <!---jvectormap js-->
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery.vmap.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery.vmap.sampledata.js') }}"></script>
    <!-- Index js-->
    <script src="{{ URL::asset('assets/js/index1.js') }}"></script>
    <!-- Data tables js-->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables.js') }}"></script>
    <!--Counters -->
    <script src="{{ URL::asset('assets/plugins/counters/counterup.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/counters/waypoints.min.js') }}"></script>
    <!--Chart js -->
    <script src="{{ URL::asset('assets/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/chart/utils.js') }}"></script>
@endsection
