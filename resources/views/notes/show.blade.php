@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($subject))
            <h1 class="text-center my-4">Notes for {{ $subject->name }}</h1>
        @else
            <h1 class="text-center my-4">Search results:</h1>
        @endif
        @if($notes->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center">No notes found</div>
            </div>
        @else
            <div class="row">
                @foreach ($notes as $note)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div id="pdf-viewer">
                                    <canvas id="pdf-canvas" width="600"></canvas>
                                </div>
                                <h5 class="card-title">{{ htmlspecialchars($note->title) }}</h5>
                                @if (isset($search))
                                    <h6 class="card-subtitle mb-2 text-muted">Subject: {{ htmlspecialchars($note->subject->name) }}</h6>
                                @endif
                                <h6 class="card-subtitle mb-2 text-muted">Author: {{ htmlspecialchars($note->user->name) }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Uploaded: {{ htmlspecialchars($note->created_at) }}</h6>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('notes.describe', $note->id) }}" class="btn btn-primary w-100">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
  <script>
    // Ensure the note object is set and the path is available
    @if (isset($note) && isset($note->path))
        // URL of the PDF file
        const pdfUrl = "{{ asset('storage/' . $note->path) }}";

        // Asynchronous function to render PDF
        const renderPdf = async () => {
            try {
                // Fetch the PDF document
                const loadingTask = pdfjsLib.getDocument(pdfUrl);
                const pdf = await loadingTask.promise;

                // Get the first page of the PDF
                const pageNumber = 1;
                const page = await pdf.getPage(pageNumber);

                // Set canvas to appropriate scale
                const scale = 1.5;
                const viewport = page.getViewport({ scale });

                const canvas = document.getElementById('pdf-canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                await page.render(renderContext).promise;

                // Now you have the first page rendered on the canvas
                // Convert canvas to image (PNG)
                const imageDataURL = canvas.toDataURL();

                // Example: Display the image in an img tag
                const imgElement = document.createElement('img');
                imgElement.src = imageDataURL;

                // Clear previous content of pdf-viewer div and append the image
                const pdfViewerDiv = document.getElementById('pdf-viewer');
                pdfViewerDiv.innerHTML = '';
                pdfViewerDiv.appendChild(imgElement);
            } catch (error) {
                console.error('Error rendering PDF:', error);
            }
        };

        // Execute function to render PDF when DOM is loaded
        document.addEventListener('DOMContentLoaded', renderPdf);
    @endif
</script>


@endsection
