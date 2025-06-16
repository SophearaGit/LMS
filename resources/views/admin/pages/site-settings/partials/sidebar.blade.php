<div class="col-12 col-md-3 border-end">
    <div class="card-body">
        <h4 class="subheader">Business settings</h4>
        <div class="list-group list-group-transparent">
            <a href="{{ route('admin.site-settings.index') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ $pageTitle == 'CAIDT | General Settings' ? 'active' : '' }}">
                <i class="ti ti-settings mb-1"></i>
                <span class="ms-2">General Settings</span>
            </a>
            <a href="{{ route('admin.site-settings.commission-settings') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ $pageTitle == 'CAIDT | Commission Settings' ? 'active' : '' }}">
                <i class="ti ti-businessplan mb-1"></i>
                <span class="ms-2">Commission Settings</span>
            </a>
            {{-- smtp settings --}}
            <a href="{{ route('admin.site-settings.smtp-settings') }}"
                class="list-group-item list-group-item-action d-flex align-items-center {{ $pageTitle == 'CAIDT | SMTP Settings' ? 'active' : '' }}">
                <i class="ti ti-mail mb-1"></i>
                <span class="ms-2">SMTP Settings</span>
            </a>

            {{-- <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Connected
                Apps</a>
            <a href="./settings-plan.html"
                class="list-group-item list-group-item-action d-flex align-items-center">Plans</a>
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">Billing
                &amp; Invoices</a> --}}
        </div>
        {{-- <h4 class="subheader mt-4">Experience</h4>
        <div class="list-group list-group-transparent">
            <a href="#" class="list-group-item list-group-item-action">Give
                Feedback</a>
        </div> --}}
    </div>
</div>
