@extends('layout.erp.app')
@section('content')
<div class="col-xl-12">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h5>Employee Create Form</h5>
            </div>
            <div class="prism-toggle">
                <a href="{{url('/employee')}}" class="btn btn-sm btn-primary-light">Employee List</a>
            </div>
        </div>
        <div class="card-body">
            <form class="row g-3 mt-0" action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Employee Name</label>
                    <input type="text" class="form-control" placeholder="First name"
                        aria-label="First name">
                </div>

                 <div class="col-md-6">
                    <label for="inputState" class="form-label">Designation</label>
                    <select id="inputState" class="form-select form-select-lg">
                        <option selected>Choose...</option>
                        @forelse ($roles as $role)

                        <option value="{{ $role->id }}">{{$role->name}}</option>
                        @empty
                        <option value="">Data Not Found</option>
                        @endforelse
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="inputState" class="form-label">Department</label>
                    <select name="" id="inputState" class="form-select form-select-lg">
                        <option selected>Choose...</option>
                        @forelse ($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>

                        @empty
                        <option value=""></option>
                        @endforelse

                    </select>
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email id">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Phone</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Mobile phone">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Present Address</label>
                    <input type="text" class="form-control" id="inputAddress"
                        placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Permanent Address</label>
                    <input type="text" class="form-control" id="inputAddress2"
                        placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="formFileSm" class="form-label">Photo</label>
                    <input type="file" class="form-control form-control-sm" id="formFileSm">
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Employee Status</label>
                    <select name="status" id="inputState" class="form-select form-select-lg">
                        <option selected>Choose...</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
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
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
