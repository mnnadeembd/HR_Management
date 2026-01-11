@extends("layout.erp.app")
@section("content")

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Roles Table</h5>
                <a href="staticBackdrop" class="btn btn-success btn-sm" type="button">
                    <i class="ri-add-line me-1"></i> Create a new role
                </a>
            </div>



            {{-- <!-- Modal for create-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a role</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input class="form-control form-control-sm mb-3" type="text"
                                placeholder="Write role name" aria-label=".form-control-sm example">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal for edit-->
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Role</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{URL("role/save", $role->id)}}" method="POST" enctype="multipart/form-data" class="p-4 border rounded">

                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label">Role name</label>
                                    <input value="{{$role->name}}" type="text" name="name" class="form-control" >
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success">Change</button>
                        </div>
                    </div>
                </div>
            </div> --}}



            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-striped-columns align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Basic Salary</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{$role->salary?->salarie_id }}</td>
                                <td class="text-center">
                                    @csrf
                                    <button class="btn btn-sm btn-info btn-wave me-1">
                                        <i class="ri-eye-line me-1"></i>View
                                    </button>

                                    <a href="{{url('/role', $role->id)}}">  <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" class="btn btn-sm btn-primary btn-wave me-1">
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
                    {{ $roles->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
