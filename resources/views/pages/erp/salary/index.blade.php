@extends("layout.erp.app")
@section("content")

<div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">

                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center w-100">
                        <h5 class="card-title mb-0">Salary Record Table</h5>
                        <a href="{{url('salary/create')}}" class="btn btn-success btn-sm" type="button">
                            <i class="ri-add-line me-1"></i> add a new employee
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Employee Name</th>
                                    <th>Month</th>
                                    <th>Basic</th>
                                    <th>Deduction</th>
                                    <th>Net amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($salaries as $salarie)
                                    <tr>
                                        <th scope="row">{{ $salarie->id }}</th>
                                        <td>{{ $salarie->user?->name }}</td>
                                        <td>{{ $salarie->month }}</td>
                                        <td>{{ $salarie->basic_salary }}</td>
                                        <td>{{ $salarie->deduction }}</td>
                                        <td>{{ $salarie->net_salary }}</td>
                                        <td class="text-center">

                                            <a href=""
                                                class="btn btn-sm btn-info btn-wave me-1">
                                                <i class="ri-eye-line me-1"></i>
                                            </a>

                                            <a href="{{ url('/salary/edit', $salarie->id) }}"> <button type="button"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop2"
                                                    class="btn btn-sm btn-primary btn-wave me-1">
                                                    <i class="ri-edit-line me-1"></i>
                                                </button></a>
                                            @csrf
                                            @method("delete")
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

                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $salaries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
