@extends("layout.erp.app")
@section("content")

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Create a New Leave Type</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <form action="{{ route('leavetype.store') }}" method="POST">
                    @csrf

                    <div class="row align-items-end g-3">
                        <!-- Input Field -->
                        <div class="col-md-9 col-12">
                            <label for="leave_type_name" class="form-label">
                                Name of Leave Type
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="leave_type_name"
                                class="form-control border-dotted"
                                placeholder="Write here"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-3 col-12">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="ri-save-line me-1"></i> Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>




@endsection
