@extends('layout.erp.app')
@section('content')


    <div class="container-fluid page-container main-body-container">

        <!-- Start::page-header -->
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0">Profile Settings</h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                </ol>
            </div>
        </div>
        <!-- End::page-header -->

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Account
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <div class="d-flex align-items-start flex-wrap gap-3">
                                    <div>
                                        <span class="avatar avatar-xxl">
                                            <img src="../assets/images/faces/9.jpg" alt="">
                                        </span>
                                    </div>
                                    <div>
                                        <span class="fw-medium d-block mb-2">Profile Picture</span>
                                        <div class="btn-list mb-1">
                                            <button class="btn btn-sm btn-primary btn-wave"><i
                                                    class="ri-upload-2-line me-1"></i>Change Image</button>
                                            <button class="btn btn-sm btn-light btn-wave"><i
                                                    class="ri-delete-bin-line me-1"></i>Remove</button>
                                        </div>
                                        <span class="d-block fs-12 text-muted">Use JPEG, PNG, or GIF. Best size: 200x200
                                            pixels. Keep it under 5MB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label for="profile-user-name" class="form-label">User Name :</label>
                                <input type="text" class="form-control" id="profile-user-name" value=""
                                    placeholder="Enter Name">
                            </div>
                            <div class="col-xl-6">
                                <label for="profile-email" class="form-label">Email :</label>
                                <input type="email" class="form-control" id="profile-email" value=""
                                    placeholder="Enter Email">
                            </div>
                            <div class="col-xl-6">
                                <label for="profile-phn-no" class="form-label">Phone No :</label>
                                <input type="text" class="form-control" id="profile-phn-no" value=""
                                    placeholder="Enter Number">
                            </div>
                            <div class="col-xl-3">
                                <label for="profile-age" class="form-label">Age :</label>
                                <input type="number" class="form-control" id="profile-age" value=""
                                    placeholder="Enter Age">
                            </div>
                            <div class="col-xl-3">
                                <label for="profile-designation" class="form-label">Designation :</label>
                                <input type="text" class="form-control" id="profile-designation" value=""
                                    placeholder="Enter Designation">
                            </div>
                            <div class="col-xl-12">
                                <label for="profile-address" class="form-label">Address :</label>
                                <textarea class="form-control" id="profile-address" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Change Password
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-xl-6">
                                <label for="Password" class="form-label">New Password</label>
                                <input type="text" class="form-control" id="Password" value=""
                                    placeholder="Enter Password">
                            </div>
                            <div class="col-xl-6">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="text" class="form-control" id="confirm-password" value=""
                                    placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary float-end">Save Changes</button>
                    </div>
                </div>
            </div>


        </div>
        <!--End::row-1 -->

    </div>
@endsection
