@extends("layout.erp.app")
@section("content")


<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Create a New Role</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf

                    <div class="row align-items-end g-3">
                        <!-- Input Field -->
                        <div class="col-md-6 col-12">
                            <label for="role_name" class="form-label">
                                Role Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="role_name"
                                class="form-control border-dotted"
                                placeholder="Write here"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Select Salary</label>
                            <select name="salarie_id" class="form-select">
                                <option value="">-- Select Salary --</option>

                                @foreach($salaries as $salary)
                                <option value="{{ $salary->id }}">
                                    {{ number_format($salary->basic_salary) }} Tk
                                </option>
                                @endforeach
                            </select>
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