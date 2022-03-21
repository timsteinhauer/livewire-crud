<div class="crud-main">
    {{-- Stop trying to control. For sure! --}}

    <div class="overflow-auto p-md-5">

        @if( $pageStyle == "page")
            {{-- use a page layout for the hole crud module --}}
            @includeFirst([
                    $childPath .".views.page",
                    $path. ".views.page"
                    ])

        @else
            {{-- use a page layout for the index page --}}
            @includeFirst([
                        $childPath .".views.page",
                        $path. ".views.page"
                        ], ["currentPage" => "index"])


            @if( $currentPage != "index")
                {{-- use a modal layout for the subpages --}}
                @includeFirst([
                        $childPath .".views.modal",
                        $path. ".views.modal"
                        ])
            @endif
        @endif
    </div>
</div>
