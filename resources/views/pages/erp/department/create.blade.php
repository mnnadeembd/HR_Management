@extends("layout.erp.app")
@section("content")

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Create a New Department</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('department.store') }}" method="POST">
                    @csrf

                    <div class="row align-items-end g-3">

                        <!-- Input Field -->
                        <div class="col-md-4 col-12">
                            <label for="department_name" class="form-label">
                                Department Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="department_name"
                                class="form-control border-dotted"
                                placeholder="Write here...."
                                value="{{ old('name') }}"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-2 col-12">
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
