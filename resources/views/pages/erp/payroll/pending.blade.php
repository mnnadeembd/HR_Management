@extends('layout.erp.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Pending Payroll Approval</h5>
    </div>

    <form action="{{ route('payroll.approve') }}" method="POST">
        @csrf

        <div class="card-body">

            {{-- Payment Date --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Payment Date</label>
                    <input type="date" name="payment_date" class="form-control" required>
                </div>
            </div>

            {{-- Payroll Table --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th>Employee</th>
                        <th>Month</th>
                        <th>Gross</th>
                        <th>Deduction</th>
                        <th>Net</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($payrolls as $payroll)
                        <tr>
                            <td>
                                <input type="checkbox" name="payroll_ids[]"
                                    value="{{ $payroll->id }}">
                            </td>
                            <td>{{ $payroll->employee->user->name ?? '' }}</td>
                            <td>{{ $payroll->salary_month }}</td>
                            <td>{{ $payroll->gross_salary }}</td>
                            <td>{{ $payroll->total_deduction }}</td>
                            <td>{{ $payroll->net_salary }}</td>
                            <td>
                                <span class="badge bg-warning">Pending</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                Approve Selected Payroll
            </button>
        </div>

    </form>
</div>

{{-- JS --}}
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        document.querySelectorAll('input[name="payroll_ids[]"]').forEach(cb => {
            cb.checked = this.checked;
        });
    });
</script>
@endsection
