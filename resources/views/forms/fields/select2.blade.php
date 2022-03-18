
@php( $select2Name = str_replace('.','', str_replace('_','', $keyPath)))
<div class="input-group mb-3 {{ $config["class"] ?? "" }}" style="{{ $config["style"] ?? "" }}">

    <script wire:ignore>
        var select2Options{{ $select2Name }} =
            [ @foreach($config["options"] as $option)
            {id: {!! $option["id"] ?? "''" !!}, text: "{{ $option["name"] }}"},
                @endforeach ];
    </script>

    <span class="input-group-text">{{ $title }}</span>

    <div wire:ignore class="flex-1 ts-lw-crud-select2-wrapper">
        <select id="select2-dropdown-{{ $select2Name }}"
                class="form-select @error($keyPath) is-invalid @enderror"
                {{ isset($config["required"]) && $config["required"] ? "required" : "" }}
        >
        </select>
    </div>

    @if( isset($config["prefix"]))
        <span class="input-group-text">{!! $config["prefix"] !!}</span>
    @endif

    @error($keyPath)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

@push('scripts')
    <script>
        window.livewire.on('refresh{{ $select2Name }}', refresh => {
            if( typeof select2{{ $select2Name }}Load == "function"){
                console.log('call {{ $select2Name }}');
                select2{{ $select2Name }}Load(refresh);
            }
        });

        function select2{{ $select2Name }}Load(refresh = null){
            if (jQuery('#select2-dropdown-{{ $select2Name }}').hasClass("select2-hidden-accessible")) {
                // Select2 has been initialized
                jQuery('#select2-dropdown-{{ $select2Name }}').select2('destroy');
                jQuery('#select2-dropdown-{{ $select2Name }} option').remove();
            }

            if( refresh != null){
                var json = JSON.parse(refresh);
                var array = [];
                for (var i=0;i<json.length;i++) {
                    array.push({id: json[i]["id"], text: json[i]["name"]});
                }
                jQuery('#select2-dropdown-{{ $select2Name }}').select2({
                    data: array,
                });
            }else{
                jQuery('#select2-dropdown-{{ $select2Name }}').select2({
                    data: select2Options{{ $select2Name }},
                });
            }
        }

        jQuery(document).ready(function () {
            select2{{ $select2Name }}Load();

            jQuery('#select2-dropdown-{{ $select2Name }}').on('change', function (e) {
                var data = $('#select2-dropdown-{{ $select2Name }}').select2("val");
            @this.set('{{ $keyPath }}', data);
            });

            $('#select2-dropdown-{{ $select2Name }}').on('select2:open', function(e) {
                $('input.select2-search__field').prop('placeholder', '{{ isset($config["placeholder"]) ? $config["placeholder"] : "Tippen um zu filtern..." }}');
            });
        });

    </script>
@endpush
