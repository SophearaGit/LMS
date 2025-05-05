<style>
    .unique-list-container {
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        width: 100%;
        box-sizing: border-box;
    }

    .unique-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        /* Stack items vertically */
    }

    .unique-list-item {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 8px 0;
        /* Add padding for spacing */
        border-bottom: 1px solid #eaeaea;
        /* Optional: add a bottom border for separation */
    }

    .unique-icon {
        font-size: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #007bff;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        margin-right: 12px;
    }

    .unique-text {
        flex: 1;
        font-size: 16px;
        color: #333;
    }

    .unique-actions {
        display: flex;
        gap: 10px;
    }

    .unique-action-icon {
        font-size: 18px;
        width: 24px;
        height: 24px;
        color: #007bff;
        cursor: pointer;
    }
</style>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sort Chapter</h5>
        <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="modal"
            aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="unique-list-container">
            <form action="">
                @csrf
                <ul class="unique-list chapter_sortable_list">
                    @foreach ($chapters as $chapter)
                        <li class="unique-list-item" data-course-id="{{ $chapter->course_id }}"
                            data-chapter-id="{{ $chapter->id }}">
                            <span class="unique-icon">📂</span>
                            <span class="unique-text"><strong>{{ $chapter->title }}</strong></span>
                            <span class="unique-actions">
                                <span class="unique-action-icon">
                                    <a class="arrow dragger" href="javascript:;">
                                        <i class="ti ti-arrows-move" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </form>
        </div>
    </div>
</div>

<script>
    // SORTING CHAPTER
    if ($('.chapter_sortable_list li').length) {
        $('.chapter_sortable_list').sortable({
            items: "li",
            containment: "parent",
            cursor: "move",
            handle: ".dragger",
            forcePlaceholderSize: true,
            update: function(event, ui) {
                let orderIds = $(this).sortable("toArray", {
                    attribute: "data-chapter-id"
                })
                let courseId = ui.item.data("course-id")
                $.ajax({
                    method: "POST",
                    url: base_admin_url + `/admin/course-content/${courseId}/sort-chapter`,
                    data: {
                        _token: csrf_token,
                        order_ids: orderIds,
                    },
                    success: function(data) {
                        const notyf = new Notyf({
                            duration: 8000,
                            dismissible: true,
                            position: {
                                x: 'right',
                                y: 'bottom',
                            },
                        });
                        notyf.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        const notyf = new Notyf({
                            duration: 8000,
                            dismissible: true,
                            position: {
                                x: 'right',
                                y: 'bottom',
                            },
                        });
                        notyf.error(error);

                    },
                })
            }
        });
    }
</script>
