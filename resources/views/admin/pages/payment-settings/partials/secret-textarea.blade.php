{{--
    Long secret (e.g. an RSA private key). When one is saved it stays hidden
    behind a summary; "Show" reveals it, "Replace" clears it for a new one.
    Expects $name, $value.
--}}
@php $hasValue = trim((string) $value) !== ''; @endphp
<div id="{{ $name }}-box">
    @if ($hasValue)
        <div class="ps-secret-saved" data-ps-saved>
            <span class="d-inline-flex align-items-center gap-2 min-w-0">
                <i class="ti ti-lock text-green"></i>
                <span>Key saved <code>…{{ substr(trim((string) $value), -8) }}</code></span>
            </span>
            <span class="d-flex gap-2">
                <button type="button" class="btn btn-sm" data-ps-unlock="{{ $name }}-box" data-mode="show"><i class="ti ti-eye me-1"></i> Show</button>
                <button type="button" class="btn btn-sm btn-outline-primary" data-ps-unlock="{{ $name }}-box" data-mode="replace"><i class="ti ti-replace me-1"></i> Replace</button>
            </span>
        </div>
    @endif
    <textarea class="form-control ps-key {{ $hasValue ? 'd-none' : '' }}" id="{{ $name }}" name="{{ $name }}" rows="6" spellcheck="false"
        placeholder="-----BEGIN PRIVATE KEY----- …">{{ $value }}</textarea>
</div>
