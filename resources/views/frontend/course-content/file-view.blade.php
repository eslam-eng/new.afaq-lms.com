
<div class="mb-3 download_link_area_in_course_content">
@if( in_array($lecture->attachment->mime_type,['pdf','application/pdf']))
    <iframe height="700px" width="100%" src="{{ $lecture->attachment->url }}#toolbar=0" class="mb-3"></iframe>
@else
    <div class="d-flex justify-content-center w-100 download_inner_continaer align-items-center">
        <a class="download_file_in_course_content" href="{{ $lecture->attachment->url }}" download>
            <div class="download_icon"><i class="fas fa-download"></i></div>
            <div class="download_text">{{ __('global.downloadFile') }}</div>
        </a>
    </div>
@endif
</div>

@section('scripts')
    @parent

    <script>
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '{{ $lecture->attachment->url }}';

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var pdfjsLib = window['pdfjs-dist/build/pdf'];

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        // Asynchronous download of PDF
        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            // Fetch the first page
            var pageNumber = 1;
            pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');

                var scale = 1.5;
                var viewport = page.getViewport({
                    scale: scale
                });

                // Prepare canvas using PDF page dimensions
                var canvas = document.getElementById('the-canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    console.log('Page rendered');
                });
            });
        }, function(reason) {
            // PDF loading error
            console.error(reason);
        });
    </script>
@endsection
