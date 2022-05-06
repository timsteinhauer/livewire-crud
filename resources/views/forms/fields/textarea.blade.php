<div class="input-group {{ $config["class"] ?? "mb-3" }}" style="{{ $config["style"] ?? "" }}">

    <label class="input-group-text" for="{{ $keyPath }}">{!! $title !!}</label>

    <textarea id="{{ $keyPath }}"
              class="form-control @error($keyPath) is-invalid @enderror"
              wire:model.debounce.500ms="{{ $keyPath }}"
              {{ isset($config["rows"]) && $config["rows"] ? "rows=".$config["rows"] : "" }}
              {{ isset($config["required"]) && $config["required"] ? "required" : "" }}
              {{ isset($config["disabled"]) && $config["disabled"] ? "disabled" : "" }}
              placeholder="{{ $config["placeholder"] ?? "" }}">

    </textarea>

    @if( isset($config["prefix"]))
        <span class="input-group-text">{!! $config["prefix"] !!}</span>
    @endif

    @error($keyPath)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
