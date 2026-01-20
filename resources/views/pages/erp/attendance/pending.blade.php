@extends('layout.erp.app')
@section('content')
    <h4>Pending Attendances</h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $att)
                <tr>
                    <td>{{ optional($att->employee)->user->name ?? 'N/A' }}</td>
                    <td>{{ $att->date ?? '-' }}</td>
                    <td>{{ $att->check_in ?? '-' }}</td>
                    <td>{{ $att->check_out ?? '-' }}</td>
                    <td>
                        @php
                            $user = auth()->user();
                            $employee = optional($user->employee); // prevents null
                            $allowedDepartments = [1, 7];
                        @endphp

                        @if ($user->role_id == 1 || $user->role_id == 2 || in_array($employee->department_id, $allowedDepartments))
                            <form action="{{ route('attendance.approve', $att->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>
                        @else
                            <span class="text-muted">Not allowed</span>
                        @endif

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
