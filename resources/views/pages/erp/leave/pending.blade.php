@extends('layout.erp.app')
@section('content')

<div class="card custom-card">
    <div class="card-header">
        <h5 class="card-title mb-0">Pending Leave Requests</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Leave Type</th>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee->user->name }}</td>
                    <td>{{ $leave->leaveType->name }}</td>
                    <td>{{ $leave->start_date }} → {{ $leave->end_date }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td class="d-flex gap-1">
                        <form action="{{ route('leave.approve', $leave->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('leave.reject', $leave->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No pending leave</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
