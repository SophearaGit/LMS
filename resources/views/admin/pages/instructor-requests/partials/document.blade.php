@php
    $mobile = $mobile ?? false;
    $chipTone = match ($docExt) {
        'pdf' => 'bg-red-lt',
        'doc', 'docx' => 'bg-blue-lt',
        'jpg', 'jpeg', 'png' => 'bg-purple-lt',
        default => 'bg-secondary-lt',
    };
@endphp
@if ($item->document)
    <div class="d-flex align-items-center gap-2 {{ $mobile ? 'flex-wrap' : '' }}">
        <span class="ir-file-chip {{ $chipTone }}">
            <i class="ti {{ $docExt === 'pdf' ? 'ti-file-type-pdf' : (in_array($docExt, ['jpg', 'jpeg', 'png']) ? 'ti-photo' : 'ti-file-text') }}"></i>
            {{ $docExt ?: 'file' }}
        </span>
        @if (in_array($docExt, $previewable))
            <a href="{{ asset($item->document) }}" target="_blank" rel="noopener"
                class="btn btn-sm btn-ghost-primary" title="Open in a new tab">
                <i class="ti ti-eye me-1"></i> View
            </a>
        @endif
        <a href="{{ route('admin.instructor_doc_downloads', $item->id) }}" class="btn btn-sm btn-ghost-secondary"
            title="Download document">
            <i class="ti ti-download me-1"></i> Download
        </a>
    </div>
@else
    <span class="text-secondary small">
        <i class="ti ti-file-off me-1"></i>
        {{ $rowStatus === 'rejected' ? 'Removed after rejection' : 'No document' }}
    </span>
@endif
