<div class="input-group mb-3 {{ $config["class"] ?? "" }}" style="{{ $config["style"] ?? "" }}">

    <label class="input-group-text" for="{{ $keyPath }}">{{ $title }}</label>

    <select multiple class="form-select @error($keyPath) is-invalid @enderror" id="{{ $keyPath }}"
            wire:model.debounce.500ms="{{ $keyPath }}"
        {{ isset($config["required"]) && $config["required"] ? "required" : "" }}
        {{ isset($config["disabled"]) && $config["disabled"] ? "disabled" : "" }}
    >
        @foreach($config["options"] as $option)
            <option value="{{ $option["id"] }}">{!! $option["name"] !!}</option>
        @endforeach
    </select>

    @if( isset($config["prefix"]))
        <span class="input-group-text">{!! $config["prefix"] !!}</span>
    @endif

    @error($keyPath)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
