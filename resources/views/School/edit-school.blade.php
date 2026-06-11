<?php
use App\Http\Controllers\Helper;
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit School</h4>
                        <a href="{{ route('school.allSchools') }}" class="btn text-white" style="background-color: #287C44;">
                            <i class="fas fa-school me-2"></i> All Schools
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="updateSchoolForm">
                            @csrf
                            <input type="hidden" name="school_id" value="{{ $school->id }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>School Type</label>
                                        <select name="school_type" class="form-control">
                                            <option value="single" {{ ($school->school_type=='single')? 'selected' : '' }}>Single</option>
                                            <option value="mixed" {{ ($school->school_type=='mixed')? 'selected' : '' }}>Mixed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>School Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $school->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email (optional)</label>
                                        <input type="email" name="email" class="form-control" value="{{ $school->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone (optional)</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $school->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="3">{{ $school->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Registration Code</label>
                                        <input type="text" name="registration_code" class="form-control" value="{{ $school->registration_code }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Update School
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#updateSchoolForm').on('submit', function(e) {
                e.preventDefault();

                var $form = $(this);
                var name = $form.find('[name="name"]').val().trim();
                if (!name) {
                    Swal.fire({ icon: 'error', title: 'Name required', text: 'Please provide the school name.' });
                    return;
                }

                Swal.fire({
                    title: 'Confirm update',
                    text: 'Update school information?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(function(res) {
                    if (!res.isConfirmed) return;

                    var $btn = $form.find('button[type="submit"]');
                    var original = $btn.html();
                    $btn.prop('disabled', true).html('Updating...');

                    $.ajax({
                        url: '{{ route('update.school') }}',
                        method: 'POST',
                        data: $form.serialize(),
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success: function() {
                            Swal.fire('Updated', 'School updated successfully', 'success').then(function() {
                                window.location.href = '{{ route('school.allSchools') }}';
                            });
                        },
                        error: function(xhr) { $('body').html(xhr.responseText); },
                        complete: function() { $btn.prop('disabled', false).html(original); }
                    });
                });
            });
        });
    </script>
@endsection

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" id="btnUpdateSchool" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Update School
                                            </button>
                                        </div>
                                    </div>

                                </form>
