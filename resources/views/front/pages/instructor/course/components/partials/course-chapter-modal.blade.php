<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <span class="strong h5">
                {{ @$on_edit == true ? 'Edit' : 'Create' }}
            </span>
            Chapter
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form
            action="{{ @$on_edit == true
                ? route('instructor.course-content.update-chapter', $chapter_id)
                : route('instructor.course-content.store-chapter', $course_id) }}"
            method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" required
                    value="{{ @$chapter?->title }}">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{ @$on_edit == true ? 'Update' : 'Save' }}</button>
            </div>
        </form>
    </div>
</div>
