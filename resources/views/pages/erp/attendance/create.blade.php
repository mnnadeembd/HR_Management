@extends('layout.erp.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employee Attendance</h5>
                <a href="{{ route('attendance.index') }}" class="btn btn-success btn-sm">
                    <i class="ri-add-line me-1"></i> Attendance List
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf

                    <!-- Date & Department -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <select id="department" class="form-control">
                                <option value="">Select Department</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Employees & Attendance Type -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Employees</label>
                            <div id="employee-list" class="border rounded p-2" style="min-height: 120px;">
                                <!-- AJAX employees -->
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label d-block">Attendance Type</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="checkIn" value="check_in" checked>
                                <label class="form-check-label" for="checkIn">Check In</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="checkOut" value="check_out">
                                <label class="form-check-label" for="checkOut">Check Out</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Time</label>
                            <input type="time" name="time" id="attendance-time" class="form-control" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    const departmentSelect = document.getElementById('department');
    const employeeList = document.getElementById('employee-list');
    const timeInput = document.getElementById('attendance-time');
    const checkInRadio = document.getElementById('checkIn');
    const checkOutRadio = document.getElementById('checkOut');

    // Function to update default time based on radio selection
    function updateTimeDefault() {
        if (checkInRadio.checked) {
            timeInput.value = "09:00";
        } else if (checkOutRadio.checked) {
            timeInput.value = "17:00";
        }
    }

    // Set default time on page load
    updateTimeDefault();

    // Event listeners on radio buttons
    checkInRadio.addEventListener('change', updateTimeDefault);
    checkOutRadio.addEventListener('change', updateTimeDefault);

    // Department change - AJAX employees
    departmentSelect.addEventListener('change', function() {
        let departmentId = this.value;
        employeeList.innerHTML = '';

        if (!departmentId) return;

        fetch(`/attendance/employees/${departmentId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(emp => {
                    employeeList.innerHTML += `
                        <div>
                            <label>
                                <input type="checkbox" name="employees[]" value="${emp.id}">
                                ${emp.user.name} (${emp.id})
                            </label>
                        </div>
                    `;
                });
            });
    });
</script>
@endpush
