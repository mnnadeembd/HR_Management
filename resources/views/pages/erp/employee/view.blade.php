@extends('layout.erp.app')
@section('content')

<div class="col-xl-12">

    <div class="card custom-card shadow-sm">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h5 class="mb-0">Employee Details</h5>
            </div>
            <div>
                <a href="{{ route('employee.edit', $employee->id) }}"
                   class="btn btn-sm btn-primary-light">
                    Edit
                </a>
                <a href="{{ url('/employee') }}"
                   class="btn btn-sm btn-light ms-2">
                    Back
                </a>
            </div>
        </div>

        <div class="card-body">

            {{-- 🔝 Profile Section --}}
            <div class="text-center mb-4">
                <img src="{{ $employee->photo
                    ? asset('uploads/employees/'.$employee->photo)
                    : asset('assets/images/faces/12.jpg') }}"
                     width="130"
                     class="rounded-circle border shadow-sm mb-2">
                <h5 class="fw-semibold mb-0">{{ $employee->user?->name ?? 'N/A' }}</h5>
                <span class="text-muted">
                    {{ $employee->role->name ?? 'N/A' }}
                </span>
            </div>

            <hr>

            {{-- 📄 Information Section --}}
            <div class="row g-4">

                {{-- Left Column --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Department</label>
                        <p class="form-control-plaintext">
                            {{ $employee->department->name ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <p class="form-control-plaintext">
                            {{ $employee->user?->email }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contact Number</label>
                        <p class="form-control-plaintext">
                            {{ $employee->phone }}
                        </p>
                    </div>

                </div>

                {{-- Right Column --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Employee Status</label>
                        <p>
                            <span class="badge 
                                {{ $employee->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $employee->status }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Joining Date</label>
                        <p class="form-control-plaintext">
                            {{ \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') }}
                        </p>
                    </div>

                </div>

                {{-- Addresses --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Present Address</label>
                    <p class="form-control-plaintext">
                        {{ $employee->present_address?? '--' }}
                    </p>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Permanent Address</label>
                    <p class="form-control-plaintext">
                        {{ $employee->permanent_address?? '--' }}
                    </p>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
