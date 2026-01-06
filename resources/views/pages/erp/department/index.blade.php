@extends("layout.erp.app")
@section("content")

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Department Table</h5>
                <a href="{{ url('/department/create') }}" class="btn btn-success btn-sm">
                    <i class="ri-add-line me-1"></i> Create a new role
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-striped-columns align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Department Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td class="text-center">

                                    <!-- Edit Button -->
                                    <a href="{{ url('/department/edit/'.$department->id) }}"
                                       class="btn btn-sm btn-primary btn-wave me-1">
                                        <i class="ri-edit-line me-1"></i> Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ url('/department/delete/'.$department->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger btn-wave"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="ri-delete-bin-line me-1"></i> Remove
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No departments found
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $departments->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
