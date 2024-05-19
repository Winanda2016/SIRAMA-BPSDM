<div class="modal fade" id="{{ $id_modal ?? 'Default id' }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-gradient bg-primary">
                <h5 class="modal-title text-white" id="modalLabel">@yield('title', 'Default Title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $isiModal ?? '' !!}
            </div>
        </div>
    </div>
</div>