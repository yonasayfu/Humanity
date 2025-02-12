{{-- This view renders an inline PDF preview using an iframe. --}}
@if(isset($pdfUrl) && $pdfUrl)
    <iframe src="{{ $pdfUrl }}" style="width: 200px; height: 250px; border: none;"></iframe>
@else
    <span>No PDF available</span>
@endif
