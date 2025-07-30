@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- SHOW EXPENSE START---------------------- --}}

    <div class="showRessource">
        {{-- ----------------------------- EXPENSE IMAGES ----------------------------- --}}
        <!-- ----------------------------- EXPENSES ----------------------------- -->

        <?php
        //NO image for this expense
        if (!$expense->images()->exists()) {
            echo "
                                                                <div class=\"noImageText  mb-2\">
                                                                 No Image Available For Expense:
                                                                 '<span>htmlspecialchars($expense->name, ENT_QUOTES, 'UTF-8')</span>'
                                                                                                    </div>
                                                                                                    ";
        }
        ?>

        <div id="owl" class="owl-carousel owl-theme mx-auto">
            @foreach ($expense->images as $image)
                <div class="item">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $expense->name }}" id="currentImage"
                        class="position-relative">

                    <button type="button" id="fullImageButton" class="btn btn-info rounded-pill p-2  fw-bold"
                        style="position:absolute; bottom:10px; right:20px; font-size:10px;" data-bs-toggle="modal"
                        data-bs-target="#ModalFullscreen" data-image="{{ asset('storage/' . $image->path) }}">
                        Full Picture
                    </button>
                </div>
            @endforeach
        </div>
        {{-- ----------------------------- ABOUT EXPENSE-------------------------- --}}
        <div id="expenseDescription">
            <div>
                <span class="content">
                    {{ $expense->name }}
                </span>
            </div>
            <div>
                <x-go-back-button />
            </div>
        </div>
    </div>

    {{-- fullscreen modal --}}
    <div class="modal fade bg-info" id="ModalFullscreen" tabindex="-1" aria-labelledby="{{ $expense->name }} Image"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="ModalFullscreenLabel">{{ $expense->name }}</h1>
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
    {{-- ----------------------------- SHOW EXPENSE END-------------------------- --}}
@endsection
