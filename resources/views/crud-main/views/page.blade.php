<div class="-view-page -model-{{ $model }} -page-{{ $currentPage }}">

    @includeFirst([
                        $childPath .".pages.". $currentPage,
                        $path. ".pages.". $currentPage
                        ])
</div>
