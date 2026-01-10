@extends('layout.erp.app')
@section('content')


    <div class="col-xl-12">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <h5>Employee Create Form</h5>
                </div>
                <div class="prism-toggle">
                    <a href="{{ url('/employee') }}" class="btn btn-sm btn-primary-light">Employee List</a>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3 mt-0" action="{{ route('employee.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Employee Name</label>
                        <input value="{{ old('name') }}" type="text" name="name" class="form-control"
                            placeholder="First name" aria-label="First name">
                    </div>

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Designation</label>
                        <select value="{{ old('role_id') }}" name="role_id" id="inputState"
                            class="form-select form-select-lg">
                            <option selected>Choose...</option>
                            @forelse ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @empty
                                <option value="">Data Not Found</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Department</label>
                        <select name="department_id" value="{{ old('department_id') }}" id="inputState"
                            class="form-select form-select-lg">
                            <option selected>Choose...</option>
                            @forelse ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>

                            @empty
                                <option value=""></option>
                            @endforelse

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input value="{{ old('email') }}" type="email" name="email" class="form-control"
                            id="inputEmail4" placeholder="Email id">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Number</label>
                        <input type="number" value="{{ old('phone') }}" name="phone" class="form-control"
                            placeholder="Phone number" aria-label="Phone number">
                    </div>

                    <div class="col-md-6">
                        <label for="formFileSm" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control form-control-sm" id="formFileSm">
                    </div>


                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Present Address</label>
                        <input type="text" value="{{ old('present_address') }}" name="present_address"
                            class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Permanent Address</label>
                        <input type="text" value="{{ old('permanent_address') }}" name="permanent_address"
                            class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>

                    <div class="col-md-3">
                        <label for="inputState" class="form-label">Employee Status</label>
                        <select name="status" id="inputState" class="form-select form-select-lg">
                            <option selected>Choose...</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Joining Date</label>
                        <input type="date" name="joining_date" class="form-control" aria-label="dateofbirth">
                    </div>

                    <div class="col-md-6">
                        <label for="inputPassword3" class="form-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control" id="inputPassword3">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                            <label class="form-check-label" for="gridCheck3">
                                Check me out
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
