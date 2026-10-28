@php $off = $user->account_status === 'disabled'; @endphp
<form action="{{ route('admin.users.instructors.toggle-active', $user->id) }}" method="POST" class="m-0">
    @csrf
    @method('PATCH')
    <input type="hidden" name="account_status" value="{{ $off ? 'enabled' : 'disabled' }}">
    <label class="form-check form-switch m-0 d-inline-flex align-items-center gap-2" title="{{ $off ? 'Enable account' : 'Disable account' }}">
        <input class="form-check-input m-0" type="checkbox" role="switch" @checked(! $off)
            data-pp-switch data-name="{{ $user->name }}" aria-label="Account for {{ $user->name }}">
        <span class="form-check-label small fw-semibold {{ $off ? 'text-red' : 'text-green' }}">{{ $off ? 'Disabled' : 'Active' }}</span>
    </label>
</form>
