const csrf_token = $('meta[name="csrf_token"]').attr('content');
const base_url = $('meta[name="base_url"]').attr('content');

var youtubeHtml = ``;

function playerHtml(id, source_type, source, file_type) {
    let video = '';

    if (source_type === "youtube") {
        video = `
            <video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                data-setup='{
                    "techOrder": ["youtube"],
                    "sources": [{ "type": "video/youtube", "src": "${source}" }]
                }'>
            </video>
        `;
    } else if (source_type === "vimeo") {
        video = `
            <video id="vid1" class="video-js" width="640" height="264"
                data-setup='{
                    "techOrder": ["vimeo"],
                    "sources": [{ "type": "video/vimeo", "src": "${source}" }],
                    "vimeo": { "color": "#fbc51b" }
                }'>
            </video>
        `;
    } else if (source_type === "upload" || source_type === "external_link") {
        if (file_type === 'doc') {
            loadDoc(source);
            return;
        } else if (file_type === 'file') {
            video = `
                <div class="video_holder d-flex flex-column align-items-center justify-content-center" style="width: 100%; height: 700px;">
                    <div class="mb-3">
                        <i class="fas fa-solid fa-folder-open fa-4x text-warning"></i>
                    </div>
                    <p class="text-center mb-3">This is a downloadable file. Click the button below to download.</p>
                    ${source_type === 'external_link'
                    ? `<a href="${source}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>Download File
                               </a>`
                    : `<a href="${base_url}/student/enroll-courses/${id}/download-file" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>Download File
                               </a>`
                }
                </div>
            `;
            return video;
        }
        video = `
            <iframe id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                src="${source}" frameborder="0" style="width: 100%; height: 700px;" allowfullscreen>
            </iframe>
        `;
    }
    return video;
}

async function loadDoc(url) {
    const res = await fetch(url);
    if (!res.ok) {
        throw new Error(`HTTP error! status: ${res.status}`);
    }
    const blob = await res.blob();
    docx.renderAsync(blob, document.getElementsByClassName("video_holder")[0])
        .then(x => console.log("docx: finished"));
}

function updateWatchHistory(courseId, chapterId, lessonId) {
    $.ajax({
        method: 'POST',
        url: `${base_url}/student/enroll-courses/update-watch-history`,
        data: {
            '_token': csrf_token,
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
        },
        beforeSend: function () { },
        success: function (data) { },
        error: function (xhr, status, error) { }
    });
}

// on check .make_completed is a checkbox
$('.make_completed').on('change', function () {
    let courseId = $(this).data('id-course');
    let chapterId = $(this).data('id-chapter');
    let lessonId = $(this).data('id-lesson');
    let isCompleted = $(this).is(':checked') ? 1 : 0;

    $.ajax({
        method: 'POST',
        url: `${base_url}/student/enroll-courses/update-lesson-completion`,
        data: {
            '_token': csrf_token,
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            'is_completed': isCompleted
        },
        beforeSend: function () { },
        success: function (data) {
            const notyf = new Notyf();
            if (data.message) {
                notyf.success(data.message);
            } else {
                notyf.error(data.message);
            }
        },
        error: function (xhr, status, error) { }
    });
});

$('.lesson').on('click', function () {
    // reset all the class lesson and style the click one
    $('.lesson').each(function () {
        $(this).css('font-weight', 'normal');
        $(this).css('text-transform', 'none');
        $(this).css('color', '#000');
    });
    $(this).css('font-weight', 'bold');
    $(this).css('text-transform', 'uppercase');
    $(this).css('color', '#436ce8');

    let courseId = $(this).data('id-course');
    let chapterId = $(this).data('id-chapter');
    let lessonId = $(this).data('id-lesson');

    $.ajax({
        method: 'GET',
        url: `${base_url}/student/enroll-courses/get-lesson-content`,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId
        },
        beforeSend: function () {
            $('.lesson_description').html(`
                <div class="d-flex align-items-center">
                    <strong>Loading...</strong>
                </div>
            `);
        },
        success: function (data) {
            $('.video_holder').empty().html(
                playerHtml(
                    data.data.id,
                    data.data.storage,
                    data.data.file_path,
                    data.data.file_type
                )
            );

            if (videojs.getPlayers()['vid1']) {
                videojs.getPlayers()['vid1'].dispose();
            }

            if ($('#vid1').length > 0 && $('#vid1').is('video')) {
                videojs('vid1').ready(function () {
                    this.play();
                });
            }

            updateWatchHistory(courseId, chapterId, lessonId);
            $('.lesson_description').html(data.data.description);
        },
        error: function (xhr, status, error) { }
    });
});
