@extends("layout.erp.app")
@section("content")

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Designation Table</h5>
                <a href="{{url('/designation/create')}}" class="btn btn-success btn-sm" type="button">
                    <i class="ri-add-line me-1"></i> Create a new role
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-striped-columns align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Designation Name</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($designations as $designation)
                            <tr>
                                <th scope="row">{{ $designation->id }}</th>
                                <td>{{ $designation->name }}</td>
                                <td class="text-center">
                                    @csrf
                                    <a href="{{url('/designation', $designation->id)}}">  <button type="button" class="btn btn-sm btn-primary btn-wave me-1">
                                      <i class="ri-edit-line me-1"></i>Edit
                                    </button></a>

                                    <button class="btn btn-sm btn-danger btn-wave">
                                        <i class="ri-delete-bin-line me-1"></i>Remove
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No roles found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $designations->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
