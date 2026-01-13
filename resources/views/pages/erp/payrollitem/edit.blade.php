@extends('layout.erp.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">

                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center w-100">
                        <h5 class="card-title mb-0">Create Payroll Items</h5>
                        <a href="{{ url('/payrollitem') }}" class="btn btn-success btn-sm" type="button">
                            <i class="ri-add-line me-1"></i>payroll item list
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <form class="row g-3 mt-0" action="{{ route('payrollitem.update', $payrollitem->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Payroll Type -->
                        <div class="col-md-3">
                            <label class="form-label">Payroll Type</label>
                            <select name="payroll_type" class="form-select form-select-lg" required>
                                <option value="1" {{ $payrollitem->payroll_id == 1 ? 'selected' : '' }}>
                                    Allowance
                                </option>
                                <option value="2" {{ $payrollitem->payroll_id == 2 ? 'selected' : '' }}>
                                    Deduction
                                </option>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="col-md-6">
                            <label class="form-label">Payroll Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $payrollitem->title) }}" required>
                        </div>

                        <!-- Amount -->
                        <div class="col-md-3">
                            <label class="form-label">Roll Rate</label>
                            <input type="number" name="amount" class="form-control"
                                value="{{ old('amount', $payrollitem->amount) }}" required>
                        </div>

                        <!-- Submit -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <a href="{{ route('payrollitem.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
