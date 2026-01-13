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
                    <form class="row g-3 mt-0" action="{{ route('payrollitem.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-3">
                            <label class="form-label">Payroll Type</label>
                            <select name="payroll_type" class="form-select form-select-lg" required>
                                <option value="">Choose...</option>
                                <option value="1">Allowance</option>
                                <option value="2">Deduction</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Payroll Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Roll Rate</label>
                            <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" required>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
