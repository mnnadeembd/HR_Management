@extends("layout.erp.app")
@section("content")

<div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">

                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center w-100">
                        <h5 class="card-title mb-0">Payroll Items</h5>
                        <a href="{{url('payroll/create')}}" class="btn btn-success btn-sm" type="button">
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
                                    <th>Earning/Deduction</th>
                                    <th>Titel</th>
                                    <th>Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @forelse ($salaries as $salarie)
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">

                                            <a href="{{ url('/payroll/view', $employee->id) }}"
                                                class="btn btn-sm btn-info btn-wave me-1">
                                                <i class="ri-eye-line me-1"></i>
                                            </a>

                                            <a href="{{ url('/payroll/edit', $employee->id) }}"> <button type="button"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop2"
                                                    class="btn btn-sm btn-primary btn-wave me-1">
                                                    <i class="ri-edit-line me-1"></i>
                                                </button></a>
                                            @csrf
                                            @method('delete')
                                            <button onclick="return cofirm(`Are you sure`)"
                                                class="btn btn-sm btn-danger btn-wave">
                                                <i class="ri-delete-bin-line me-1"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">No employees found</td>
                                    </tr>
                                @endforelse

                            </tbody> --}}
                        </table>
                    </div>
                    <!-- Pagination -->
                    {{-- <div class="d-flex justify-content-end mt-3">
                        {{ $employees->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
