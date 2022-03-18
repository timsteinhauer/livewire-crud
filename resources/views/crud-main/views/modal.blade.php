<div class="-view-page -model-{{ $model }} -page-{{ $currentPage }}">

    <div class="modal fade show" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include($path. ".pages.". $currentPage)
                </div>
            </div>
        </div>
    </div>

    <div class="modal-backdrop fade show"></div>
</div>