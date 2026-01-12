@extends('layout.erp.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Apply Leave</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('leave.submit') }}" method="POST">
                        @csrf

                        <!-- Department -->
                        <div class="mb-3">
                            <label>Department</label>
                            <select id="department" name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Employee -->
                        <div class="mb-3">
                            <label>Employee</label>
                            <select id="employee" name="employee_id" class="form-control" required>
                                <option value="">Select Employee</option>
                            </select>
                        </div>

                        <!-- Leave Type -->
                        <div class="mb-3">
                            <label>Leave Type</label>
                            <select name="leave_type_id" class="form-control" required>
                                <option value="">Select Leave Type</option>
                                @foreach ($leaveTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dates -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Reason -->
                        <div class="mb-4">
                            <label>Reason (Max 300 words)</label>
                            <textarea name="reason" rows="4" maxlength="300" class="form-control" required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit Leave</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('department').addEventListener('change', function() {
            let deptId = this.value;
            let employeeSelect = document.getElementById('employee');

            employeeSelect.innerHTML = '<option value="">Loading...</option>';

            if (!deptId) {
                employeeSelect.innerHTML = '<option value="">Select Employee</option>';
                return;
            }

            fetch(`/leave/employees/${deptId}`)
                .then(res => res.json())
                .then(data => {
                    employeeSelect.innerHTML = '<option value="">Select Employee</option>';
                    data.forEach(emp => {
                        // value = emp.id, text = employee name
                         employeeSelect.innerHTML += `<option value="${emp.id}">${emp.user.name} - ${emp.id}</option>`;
                    });
                });
        });
    </script>
@endpush
