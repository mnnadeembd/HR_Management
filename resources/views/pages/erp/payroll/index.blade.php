@extends('layout.erp.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">

                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center w-100">
                    <h5 class="card-title mb-0">Payroll Items</h5>
                    <a href="{{ url('payroll/create') }}" class="btn btn-success btn-sm" type="button">
                        <i class="ri-add-line me-1"></i> create a new payroll
                    </a>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Employee name</th>
                                <th>Month</th>
                                {{-- <th>Gross Amount</th>
                                    <th>Total Deduction</th> --}}
                                <th>Net Amount</th>
                                <th>Status</th>
                                <th>P Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payrolls as $payroll)
                            <tr>
                                <th scope="row">{{ $payroll->id }}</th>
                                <td>{{ $payroll->employee->user->name }}</td>
                                <td>{{ $payroll->salary_month }}</td>
                                {{-- <td>{{ $payroll->gross_salary }}</td>
                                <td>{{ $payroll->total_deduction }}</td> --}}
                                <td>{{ $payroll->net_salary }}</td>
                                <td>
                                    @if ($payroll->payment_status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                    @else
                                    <span class="badge bg-warning">Unpaid</span>
                                    @endif
                                </td>
                                <td>{{ $payroll->payment_date ?? '-' }}</td>
                                
                                <td class="text-center">

                                    <!-- View -->
                                    <a href="{{ url('/payroll/payslip', $payroll->id) }}"
                                        class="btn btn-sm btn-info btn-wave me-1">
                                        <i class="ri-eye-line me-1"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ url('/payroll/edit', $payroll->id) }}"
                                        class="btn btn-sm btn-primary btn-wave me-1">
                                        <i class="ri-edit-line me-1"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('payroll.destroy', $payroll->id) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-sm btn-danger">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>

                                </td>
                                
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">No employees found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $payrolls->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection