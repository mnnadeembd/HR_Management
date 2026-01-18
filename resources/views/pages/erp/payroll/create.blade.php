@extends('layout.erp.app')
@section('content')



    <div class="row">
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
                <div class="card-header">

                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center w-100">
                        <h5 class="card-title mb-0">Create Payroll</h5>
                        <a href="{{ url('/payroll') }}" class="btn btn-success btn-sm" type="button">
                            <i class="ri-add-line me-1"></i>payroll list
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('payroll.store') }}" method="POST">
                        @csrf

                        <div class="col-md-12 row">
                            {{-- Department --}}
                            <div class="col-md-3">
                                <label class="form-label">Department</label>
                                <select id="department_id" class="form-select">
                                    <option value="">-- Select Department --</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Employee --}}
                            <div class="col-md-3">
                                <label class="form-label">Employee</label>
                                <select name="employee_id" id="employee_id" class="form-select" required>
                                    <option value="">-- Select Employee --</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}" data-department="{{ $emp->department_id }}"
                                            data-basic="{{ $emp->user?->role?->salary?->basic_salary ?? 0 }}">
                                            {{ $emp->user?->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Salary Month --}}
                            <div class="col-md-3">
                                <label class="form-label">Salary Month</label>
                                <input type="month" name="salary_month" class="form-control" required>
                            </div>


                            {{-- Basic Salary --}}
                            <div class="col-md-3">
                                <label class="form-label">Basic Salary</label>
                                <input type="number" name="basic_salary" id="basic_salary" class="form-control" readonly>
                            </div>

                        </div>



                        <hr>

                        {{-- Allowances --}}
                        <h5>Allowances</h5>
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <select id="allowance_select" class="form-select">
                                    <option value="">-- Select Allowance --</option>
                                    @foreach ($allowances as $a)
                                        <option value="{{ $a->title }}">{{ $a->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" id="allowance_amount" class="form-control" placeholder="Amount">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" onclick="addAllowance()">Add</button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="allowance_table">
                            <tbody></tbody>
                        </table>

                        {{-- Deductions --}}
                        <h5>Deductions</h5>
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <select id="deduction_select" class="form-select">
                                    <option value="">-- Select Deduction --</option>
                                    @foreach ($deductions as $d)
                                        <option value="{{ $d->title }}">{{ $d->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" id="deduction_amount" class="form-control" placeholder="Amount">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger w-100" onclick="addDeduction()">Add</button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="deduction_table">
                            <tbody></tbody>
                        </table>

                        <hr>

                        {{-- Totals --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label>Gross Salary</label>
                                <input type="text" name="gross_salary" id="gross_salary" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>Total Deduction</label>
                                <input type="text" id="total_deduction" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>Net Salary</label>
                                <input type="text" name="net_salary" id="net_salary" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Create Payroll</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        /* Department → Employee filter */
        document.getElementById('department_id').addEventListener('change', function() {
            let dept = this.value;
            document.querySelectorAll('#employee_id option').forEach(opt => {
                if (!opt.value) return;
                opt.style.display = (!dept || opt.dataset.department == dept) ? 'block' : 'none';
            });
        });

        /* Employee → Basic Salary */
        document.getElementById('employee_id').addEventListener('change', function() {
            let basic = this.selectedOptions[0]?.dataset.basic || 0;
            document.getElementById('basic_salary').value = basic;
            calculate();
        });

        let allowanceTotal = 0;
        let deductionTotal = 0;

        function addAllowance() {
            let title = allowance_select.value;
            let amount = parseFloat(allowance_amount.value || 0);
            if (!title || amount <= 0) return;

            allowanceTotal += amount;
            allowance_table.innerHTML += rowHtml(title, amount, 'allowance');
            allowance_amount.value = '';
            calculate();
        }

        function addDeduction() {
            let title = deduction_select.value;
            let amount = parseFloat(deduction_amount.value || 0);
            if (!title || amount <= 0) return;

            deductionTotal += amount;
            deduction_table.innerHTML += rowHtml(title, amount, 'deduction');
            deduction_amount.value = '';
            calculate();
        }

        function rowHtml(title, amount, type) {
            return `
    <tr>
        <td>${title}</td>
        <td>${amount}</td>
        <td>
            <button type="button" class="btn btn-sm btn-danger"
                onclick="this.closest('tr').remove(); recalc('${type}', ${amount})">
                Remove
            </button>
            <input type="hidden" name="${type}_title[]" value="${title}">
            <input type="hidden" name="${type}_amount[]" value="${amount}">
        </td>
    </tr>`;
        }

        function recalc(type, amount) {
            if (type === 'allowance') allowanceTotal -= amount;
            else deductionTotal -= amount;
            calculate();
        }

        function calculate() {
            let basic = parseFloat(basic_salary.value || 0);
            let gross = basic + allowanceTotal;

            gross_salary.value = gross;
            total_deduction.value = deductionTotal;
            net_salary.value = gross - deductionTotal;
        }
    </script>

@endsection
