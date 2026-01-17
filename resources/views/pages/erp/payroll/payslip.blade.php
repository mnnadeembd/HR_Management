{{-- @php
    dd($payroll)
@endphp --}}
@extends('layout.erp.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

@section('css')
    <style>
        body {
            background: #f4f7fa;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        /* Card Styling */
        .payslip-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .payslip-card::before {
            content: "{{ $payroll->payment_status == 'paid' ? 'PAID' : 'UNPAID' }}";
            position: absolute;
            top: 20px;
            right: -30px;
            transform: rotate(45deg);
            background: #dcfce7;
            color: #15803d;
            font-weight: 800;
            padding: 5px 40px;
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* Typography */
        .company-name {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .section-title {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            color: #64748b;
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 12px;
            padding-bottom: 5px;
            letter-spacing: 1px;
        }

        /* Table Styling */
        .table-custom {
            margin-bottom: 0;
        }

        .table-custom th {
            background: #f8fafc;
            font-weight: 600;
            color: #475569;
            border-color: #f1f5f9;
        }

        .table-custom td {
            padding: 10px;
            border-color: #f1f5f9;
            vertical-align: middle;
        }

        /* Net Pay Box */
        .net-pay-box {
            background: #0f172a;
            color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .net-pay-amount {
            font-size: 24px;
            font-weight: 700;
            color: #38bdf8;
        }

        /* Signature Section */
        .signature-box {
            margin-top: 50px;
        }

        .sig-line {
            border-top: 1px solid #cbd5e1;
            width: 180px;
            margin: 0 auto 10px;
        }

        /* Print Specific Styles */
        @media print {

            .no-print,
            .btn,
            .card-header,
            .main-footer {
                display: none !important;
            }

            body {
                background: white;
            }

            .payslip-card {
                box-shadow: none;
                border: none;
                padding: 0;
            }

            .net-pay-box {
                background: #f8fafc !important;
                color: black !important;
                border: 1px solid #e2e8f0;
            }

            .net-pay-amount {
                color: black !important;
            }
        }
    </style>
@endsection


<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="container py-5">
                <div class="row mb-4 no-print">
                    <div class="col-lg-8 mx-auto d-flex justify-content-between">
                        <a href="{{ url('/payroll') }}" class="btn btn-outline-secondary">
                            <i class="ri-arrow-left-line"></i> Back to List
                        </a>
                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="ri-printer-line"></i> Print Payslip
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="payslip-card">

                            <div class="row align-items-center mb-4">
                                <div class="col-sm-7">
                                    <div class="company-name">Castle in the air</div>
                                    <p class="text-muted mb-0">
                                        64 Mangilik El Avenue, <br> Astana, Z00A9G3<br>
                                        <i class="ri-phone-line"></i> +7 7172 77-51-18
                                    </p>
                                </div>
                                <div class="col-sm-5 text-sm-end mt-3 mt-sm-0">
                                    <h4 class="fw-bold mb-1">PAYSLIP</h4>
                                    <span class="badge bg-light text-dark border">#PS-00{{ $payroll->id }}</span>
                                    <div class="text-muted small mt-1">Period: {{ $payroll->salary_month }}</div>
                                    <div class="text-muted small mt-1">Payment Date: {{ $payroll->payment_date ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" style="opacity: 0.1;">

                            <div class="row mb-4">
                                <div class="col-6 col-sm-3">
                                    <div class="section-title">Employee</div>
                                    <p class="fw-bold mb-0">{{ $payroll->employee->user->name }}</p>
                                    <span class="text-muted small">ID: EMP-{{ $payroll->employee->id }}</span>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <div class="section-title">Designation</div>
                                    <p class="mb-0 text-dark">{{ $payroll->employee->designation->name ?? '-' }}</p>
                                    <span class="text-muted small">{{ $payroll->employee->department->name }}</span>
                                </div>
                                <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                    <div class="section-title">Bank Account</div>
                                    <p class="mb-0 text-dark">**** 4567</p>
                                    <span class="text-muted small">National Bank of Kazakhstan</span>
                                </div>
                                <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                    <div class="section-title">Days Worked</div>
                                    <p class="mb-0 text-dark">22 Days</p>
                                    <span class="text-muted small">02 Leave Days</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="section-title">Earnings</div>
                                    <table class="table table-custom border">
                                        <tbody>

                                            {{-- Basic Salary --}}
                                            <tr>
                                                <td>Basic Salary</td>
                                                <td class="text-end fw-medium">
                                                    {{ $payroll->employee->user->role->salary->basic_salary ?? '-' }}
                                                </td>
                                            </tr>

                                            {{-- Allowances --}}
                                            @foreach ($payroll->payroll_details->where('type', 'Allowance') as $detail)
                                                <tr>
                                                    <td>{{ $detail->title }}</td>
                                                    <td class="text-end fw-medium text-success">
                                                        {{ number_format($detail->amount, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                        <tfoot class="table-light">
                                            <tr>
                                                <td class="fw-bold">Gross Earnings</td>
                                                <td class="text-end fw-bold text-primary">
                                                    {{ number_format($payroll->gross_salary, 2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <div class="section-title">Deductions</div>
                                    <table class="table table-custom border">
                                        <tbody>
                                            @foreach ($payroll->payroll_details->where('type', 'Deduction') as $detail)
                                                <tr>
                                                    <td>{{ $detail->title }}</td>
                                                    <td class="text-end fw-medium text-danger">
                                                        {{ number_format($detail->amount, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <div class="net-pay-box row align-items-center mx-0">
                                <div class="col-md-7">
                                    <div class="small opacity-75 text-uppercase fw-bold">Amount in Words</div>
                                    <div class="fw-medium">{{ $payroll->net_salary_in_words() }} Only</div>
                                </div>
                                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                    <div class="small opacity-75 text-uppercase fw-bold">Net Payable</div>
                                    <div class="net-pay-amount">BDT {{ $payroll->net_salary }}</div>
                                </div>
                            </div>


                            <div class="row signature-box text-center">
                                <div class="col-6">
                                    <div class="sig-line"></div>
                                    <p class="small text-muted mb-0">Authorized Signatory</p>
                                </div>
                                <div class="col-6">
                                    <div class="sig-line"></div>
                                    <p class="small text-muted mb-0">Employee Signature</p>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <p class="text-muted mb-0" style="font-size: 11px;">
                                    This is a computer-generated document and requires no physical stamp or signature.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
