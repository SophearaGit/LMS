@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {
            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 100%;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-xl mt-4">
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">customize latest courses section (homepage)</h3>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.latest-courses.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_one" class="form-label">Category One</label>
                                        <select class="form-select select2" name="category_one" id="category_one">
                                            <option value="">Please Select</option>
                                            @foreach ($categories_for_select as $item)
                                                @if ($item->subCategories->isNotEmpty())
                                                    <optgroup label="{{ $item->name }}">
                                                        @foreach ($item->subCategories as $subItem)
                                                            <option @selected($latestCourseSection->category_one == $subItem->id)
                                                                value="{{ $subItem->id }}">
                                                                {{ $subItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category_one')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_two" class="form-label">Category Two</label>
                                        <select class="form-select select2" name="category_two" id="category_two">
                                            <option value="">Please Select</option>
                                            @foreach ($categories_for_select as $item)
                                                @if ($item->subCategories->isNotEmpty())
                                                    <optgroup label="{{ $item->name }}">
                                                        @foreach ($item->subCategories as $subItem)
                                                            <option @selected($latestCourseSection->category_two == $subItem->id)
                                                                value="{{ $subItem->id }}">
                                                                {{ $subItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category_two')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_three" class="form-label">Category Three</label>
                                        <select class="form-select select2" name="category_three" id="category_three">
                                            <option value="">Please Select</option>
                                            @foreach ($categories_for_select as $item)
                                                @if ($item->subCategories->isNotEmpty())
                                                    <optgroup label="{{ $item->name }}">
                                                        @foreach ($item->subCategories as $subItem)
                                                            <option @selected($latestCourseSection->category_three == $subItem->id)
                                                                value="{{ $subItem->id }}">
                                                                {{ $subItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category_three')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_four" class="form-label">Category Four</label>
                                        <select class="form-select select2" name="category_four" id="category_four">
                                            <option value="">Please Select</option>
                                            @foreach ($categories_for_select as $item)
                                                @if ($item->subCategories->isNotEmpty())
                                                    <optgroup label="{{ $item->name }}">
                                                        @foreach ($item->subCategories as $subItem)
                                                            <option @selected($latestCourseSection->category_four == $subItem->id)
                                                                value="{{ $subItem->id }}">
                                                                {{ $subItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category_four')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_five" class="form-label">Category Five</label>
                                        <select class="form-select select2" name="category_five" id="category_five">
                                            <option value="">Please Select</option>
                                            @foreach ($categories_for_select as $item)
                                                @if ($item->subCategories->isNotEmpty())
                                                    <optgroup label="{{ $item->name }}">
                                                        @foreach ($item->subCategories as $subItem)
                                                            <option @selected($latestCourseSection->category_five == $subItem->id)
                                                                value="{{ $subItem->id }}">
                                                                {{ $subItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category_five')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy mb-1"></i>&nbsp;
                                <span>
                                    Update
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a category',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
