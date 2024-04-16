@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="card mb-4">
            <h5 class="card-header">Chỉnh sửa người dùng mới</h5>
            <form class="card-body">
                <h6>1. Account Details</h6>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="multicol-username" class="form-control" placeholder="john.doe">
                            <label for="multicol-username">Username</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="multicol-email" class="form-control" placeholder="john.doe"
                                    aria-label="john.doe" aria-describedby="multicol-email2">
                                <label for="multicol-email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="multicol-password" class="form-control"
                                        placeholder="············" aria-describedby="multicol-password2">
                                    <label for="multicol-password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                        class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="multicol-confirm-password" class="form-control"
                                        placeholder="············" aria-describedby="multicol-confirm-password2">
                                    <label for="multicol-confirm-password">Confirm Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i
                                        class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4 mx-n4">
                <h6>2. Personal Info</h6>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="multicol-first-name" class="form-control" placeholder="John">
                            <label for="multicol-first-name">First Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="multicol-last-name" class="form-control" placeholder="Doe">
                            <label for="multicol-last-name">Last Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="multicol-birthdate" class="form-control dob-picker flatpickr-input"
                                placeholder="YYYY-MM-DD" readonly="readonly">
                            <label for="multicol-birthdate">Birth Date</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="multicol-phone" class="form-control phone-mask"
                                placeholder="658 799 8941" aria-label="658 799 8941">
                            <label for="multicol-phone">Phone No</label>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script></script>
@endsection
