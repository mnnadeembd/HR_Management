@extends('layout.erp.app')
@section('content')

<div class="container">
    <h3 class="mb-4">Create Payroll</h3>

    <form action="{{ route('payroll.store') }}" method="POST">
        @csrf

        {{-- Employee Select --}}
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">-- Select Employee --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->user->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Salary Month --}}
        <div class="mb-3">
            <label for="salary_month" class="form-label">Salary Month</label>
            <input type="month" name="salary_month" id="salary_month" class="form-control" required>
        </div>

        <hr>

        {{-- Payroll Items --}}
        <h5>Payroll Items</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payrollItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <input type="hidden" name="items[{{ $item->id }}][id]" value="{{ $item->id }}">
                                <input type="hidden" name="items[{{ $item->id }}][type]" value="{{ $item->type }}">
                                <input type="hidden" name="items[{{ $item->id }}][title]" value="{{ $item->title }}">
                                <input type="number" step="0.01" name="items[{{ $item->id }}][amount]"
                                       class="form-control" placeholder="Enter Amount" value="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Submit Button --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Create Payroll</button>
            <a href="{{ route('payroll.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

@endsection
