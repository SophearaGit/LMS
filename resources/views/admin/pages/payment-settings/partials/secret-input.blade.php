{{-- Password-style input with a show/hide button. Expects $name, $value. --}}
<div class="input-group">
    <input type="password" class="form-control ps-key" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}"
        autocomplete="new-password" spellcheck="false" placeholder="Paste the secret here">
    <button type="button" class="btn btn-icon" data-ps-reveal="{{ $name }}" aria-label="Show value" title="Show / hide">
        <i class="ti ti-eye"></i>
    </button>
</div>
