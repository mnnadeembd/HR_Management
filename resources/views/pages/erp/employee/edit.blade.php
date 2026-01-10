@extends('layout.erp.app')
@section('content')

<div class="col-xl-12">

    <div class="card custom-card shadow-sm">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h5 class="mb-0">Edit Employee</h5>
            </div>
            <div>
                <a href="{{ route('employee.show', $employee->id) }}"
                   class="btn btn-sm btn-primary-light">
                    View
                </a>
                <a href="{{ url('/employee') }}"
                   class="btn btn-sm btn-light ms-2">
                    Back
                </a>
            </div>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('employee.update', $employee->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 🔝 Profile Section --}}
                <div class="text-center mb-4">
                    <img src="{{ $employee->photo
                        ? asset('uploads/employees/'.$employee->photo)
                        : asset('assets/images/faces/12.jpg') }}"
                         width="130"
                         class="rounded-circle border shadow-sm mb-3">

                    <div class="row justify-content-center mb-2">
                        <div class="col-md-4">
                            <input type="file"
                                   name="photo"
                                   class="form-control form-control-sm">
                        </div>
                    </div>

                    <h5 class="fw-semibold mt-2">{{ $employee->user->name ?? 'N/A' }}</h5>
                    <span class="text-muted">{{ $employee->user->role->name ?? 'N/A' }}</span>
                </div>

                <hr>

                {{-- 📄 Information Section --}}
                <div class="row g-4">

                    {{-- Left Column --}}
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">Choose...</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                   class="form-control"
                                   value="{{ $employee->user->email }}"
                                   disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contact Number</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ $employee->phone }}">
                        </div>

                    </div>

                    {{-- Right Column --}}
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Joining Date</label>
                            <input type="date"
                                   name="joining_date"
                                   class="form-control"
                                   value="{{ $employee->joining_date }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password <small class="text-muted">(optional)</small></label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Leave blank to keep unchanged">
                        </div>

                    </div>

                    {{-- Addresses --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Present Address</label>
                        <textarea name="present_address"
                                  class="form-control"
                                  rows="2">{{ $employee->present_address }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Permanent Address</label>
                        <textarea name="permanent_address"
                                  class="form-control"
                                  rows="2">{{ $employee->permanent_address }}</textarea>
                    </div>

                </div>

                {{-- Submit --}}
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">
                        Update Employee
                    </button>
                    <a href="{{ route('employee.show', $employee->id) }}"
                       class="btn btn-light ms-2">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
