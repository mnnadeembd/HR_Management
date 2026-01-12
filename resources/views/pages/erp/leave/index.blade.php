@extends("layout.erp.app")
@section("content")

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">

                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center w-100">
                    <h5 class="card-title mb-0">Employee Leave Records</h5>
                    <a href="{{url('leave/form')}}" class="btn btn-success btn-sm" type="button">
                        <i class="ri-add-line me-1"></i> apply for leave
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
                                <th>Leave type</th>
                                <!-- <th>Reason for leave</th> -->
                                <th>Total leave</th>
                                <th>Status</th>
                                <!-- <th>Approved by</th> -->
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaves as $leave)
                            <tr>
                                <th scope="row">{{ $leave->id }}</th>
                                <td>{{ $leave->employee?->user?->name }}</td>
                                <td>{{ $leave->leaveType?->name }}</td>
                                <!-- <td>{{ $leave->reason }}</td> -->
                                <td class="text-center">{{ $leave->total_leaves}}</td>
                                <td><span class="badge bg-success">{{ $leave->status }}</span></td>
                                <!-- <td>{{ $leave->approved_by }}</td> -->
                                <td class="text-center">

                                    <a href="{{ url('/leave/view', $leave->id) }}"
                                        class="btn btn-sm btn-info btn-wave me-1">
                                        <i class="ri-eye-line me-1"></i>
                                    </a>

                                    <a href="{{ url('/leave/edit', $leave->id) }}"> <button type="button"
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
                                <td colspan="9" class="text-center text-danger">No attandance record found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $leaves->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
