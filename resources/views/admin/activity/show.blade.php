@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- SHOW ACTIVITY START ----------------------------- --}}

    <div class="showRessource">
        {{-- ----------------------------- ACTIVITY IMAGES ----------------------------- --}}

        <?php
    // No image for this activity
    if (!$activity->images()->exists()) {
        echo "
            <div class=\"noImageText  text-center mb-2\">
             No Image Available For Activity:
             '<span class=\"fs-6\">htmlspecialchars($activity->name,ENT_QUOTES,'UTF-8')</span>'
            </div>
            ";
    }
         ?>
        <div id="owl" class="owl-carousel owl-theme mx-auto mb-2">
            @foreach ($activity->images as $image)
                <div class="item">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $activity->name }}" id="currentImage"
                        class="position-relative">

                    <button type="button" id="fullImageButton" class="btn btn-info rounded-pill p-2 fw-bold"
                        style="position:absolute; bottom:10px; right:20px; font-size:10px;" data-bs-toggle="modal"
                        data-bs-target="#ModalFullscreen" data-image="{{ asset('storage/' . $image->path) }}">
                        Full Picture
                    </button>
                </div>
            @endforeach
        </div>

        <!-- ----------------------------- ABOUT ACTIVITY ----------------------------- -->
        <div id="activityDescription">
            <div>
                <span class="content">
                    {{ $activity->name }}
                </span>
            </div>
            <div>
                <span>
                    {{ $activity->description }}
                </span>
                <x-go-back-button />
            </div>
        </div>
    </div>

    <!-- fullscreen modal -->
    <div class="modal fade bg-info" id="ModalFullscreen" tabindex="-1" aria-labelledby="{{ $activity->name }} Image"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="ModalFullscreenLabel">{{ $activity->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <img src="" id="modal-image" class="img-fluid"
                        style="width: auto;height: auto; border-radius: 8px; margin: auto;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info p-2" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- ----------------------------- SHOW ACTIVITY START ----------------------------- --}}
@endsection
