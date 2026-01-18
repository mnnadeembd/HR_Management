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

                    {{-- Employee Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Employee Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Employee name" required>
                    </div>

                    {{-- Designation --}}
                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <select name="role_id" class="form-select form-select-lg" required>
                            <option value="">Choose...</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-select form-select-lg" required>
                            <option value="">Choose...</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Email address" required>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                            placeholder="Phone number" required>
                    </div>

                    {{-- Photo --}}
                    <div class="col-md-6">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    {{-- Present Address --}}
                    <div class="col-12">
                        <label class="form-label">Present Address</label>
                        <input type="text" name="present_address" value="{{ old('present_address') }}"
                            class="form-control" required>
                    </div>

                    {{-- Permanent Address --}}
                    <div class="col-12">
                        <label class="form-label">Permanent Address</label>
                        <input type="text" name="permanent_address" value="{{ old('permanent_address') }}"
                            class="form-control" required>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-3">
                        <label class="form-label">Employee Status</label>
                        <select name="status" class="form-select form-select-lg" required>
                            <option value="">Choose...</option>
                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Joining Date --}}
                    <div class="col-md-3">
                        <label class="form-label">Joining Date</label>
                        <input type="date" name="joining_date" value="{{ old('joining_date') }}" class="form-control"
                            required>
                    </div>

                    {{-- Password --}}
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Optional (default: 123456)">
                    </div>

                    {{-- Submit --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            Create Employee
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
