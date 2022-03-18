
<div class="input-group mb-3 {{ $config["class"] ?? "" }}" style="{{ $config["style"] ?? "" }}">
    <input type="hidden"
           id="select2-dropdown-{{ str_replace('.','-', $keyPath) }}-target"
           wire:model.debounce.500ms="{{ $keyPath }}">

    <span class="input-group-text">{{ $title }}</span>

    <div wire:ignore class="flex-1 ts-lw-crud-select2-wrapper">

        <select id="select2-dropdown-{{ str_replace('.','-', $keyPath) }}"
                class="form-select @error($keyPath) is-invalid @enderror"
                {{ isset($config["required"]) && $config["required"] ? "required" : "" }}
                {{ isset($config["disabled"]) && $config["disabled"] ? "disabled" : "" }}
        >
            @foreach($config["options"] as $option)
                <option value="{{ $option["id"] }}" {{ $option["id"] == $value ? "selected" : "" }}>{!! $option["name"] !!}</option>
            @endforeach
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
        jQuery(document).ready(function () {
            jQuery('#select2-dropdown-{{ str_replace('.','-', $keyPath) }}').select2();
            jQuery('#select2-dropdown-{{ str_replace('.','-', $keyPath) }}').on('change', function (e) {
                var data = $('#select2-dropdown-{{ str_replace('.','-', $keyPath) }}').select2("val");
                $('#select2-dropdown-{{ str_replace('.','-', $keyPath) }}-target').val(data);
            });
            jQuery('#select2-dropdown-{{ str_replace('.','-', $keyPath) }}').on('select2:open', function(e) {
                jQuery('input.select2-search__field')
                    .prop('placeholder', '{{ isset($config["placeholder"]) ? $config["placeholder"] : "Tippen um zu filtern..." }}');
            });
        });
    </script>
@endpush
