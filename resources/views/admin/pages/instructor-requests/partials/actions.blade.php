@php $stack = ($layout ?? 'row') === 'stack'; @endphp
@if ($rowStatus === 'pending')
    <div class="{{ $stack ? 'row g-2 mt-3' : 'ir-actions d-inline-flex gap-2' }}">
        <div class="{{ $stack ? 'col-6' : '' }}">
            <button type="button" class="btn btn-success {{ $stack ? 'w-100' : '' }}"
                data-bs-toggle="modal" data-bs-target="#ir-confirm"
                data-status="approved" data-name="{{ $item->name }}"
                data-action="{{ route('admin.instructor-requests.update', $item->id) }}">
                <i class="ti ti-check me-1"></i> Approve
            </button>
        </div>
        <div class="{{ $stack ? 'col-6' : '' }}">
            <button type="button" class="btn btn-outline-danger {{ $stack ? 'w-100' : '' }}"
                data-bs-toggle="modal" data-bs-target="#ir-confirm"
                data-status="rejected" data-name="{{ $item->name }}"
                data-action="{{ route('admin.instructor-requests.update', $item->id) }}">
                <i class="ti ti-x me-1"></i> Reject
            </button>
        </div>
    </div>
@elseif ($rowStatus === 'approved')
    <a href="{{ route('admin.users.instructors') }}" class="btn btn-ghost-secondary btn-sm {{ $stack ? 'w-100 mt-3' : '' }}">
        <i class="ti ti-external-link me-1"></i> Open in Instructors
    </a>
@else
    <span class="text-secondary small {{ $stack ? 'd-block mt-3' : '' }}">No action needed</span>
@endif
