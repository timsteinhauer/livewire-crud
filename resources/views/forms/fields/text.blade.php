<div class="input-group {{ $config["class"] ?? "mb-3" }}" style="{{ $config["style"] ?? "" }}">

    <label class="input-group-text {{ isset($config["required"]) && $config["required"] ? "-required" : "" }}" for="{{ $keyPath }}">{!! $title !!}</label>

    <input type="text" id="{{ $keyPath }}"
           class="form-control @error($keyPath) is-invalid @enderror"
           wire:model.debounce.500ms="{{ $keyPath }}"
           {{ isset($config["required"]) && $config["required"] ? "required" : "" }}
           {{ isset($config["disabled"]) && $config["disabled"] ? "disabled" : "" }}
           placeholder="{{ $config["placeholder"] ?? "" }}">

    @if( isset($config["prefix"]))
        <span class="input-group-text">{!! $config["prefix"] !!}</span>
    @endif

    @error($keyPath)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
