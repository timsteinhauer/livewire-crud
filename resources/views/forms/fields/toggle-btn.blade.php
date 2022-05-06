<div class="input-group {{ $config["class"] ?? "mb-3" }}" style="flex-wrap: nowrap; {{ $config["style"] ?? "" }}">

    <input type="checkbox"
           style="height: auto; width: auto; max-width: 35px;" id="{{ $keyPath }}"
           class="flex-grow-1 px-3 @error($keyPath) is-invalid @enderror"
           wire:model.debounce.500ms="{{ $keyPath }}"
            {{ isset($config["required"]) && $config["required"] ? "required" : "" }}
            {{ isset($config["disabled"]) && $config["disabled"] ? "disabled" : "" }}>

    <label class="input-group-text flex-grow-1" for="{{ $keyPath }}">{!! $title !!}</label>

    @error($keyPath)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
