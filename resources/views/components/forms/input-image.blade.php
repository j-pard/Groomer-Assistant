<div>
    {{-- Image --}}
    <div class="custom-img-container">
        @if (isset($model) && $model->getFirstMediaUrl() != null)
            <img src="{{ $model->getFirstMediaUrl() }}" alt="">
        @else
            <div class="default-avatar p-3">
                <i class="fas fa-paw"></i>
            </div>
        @endif
    </div>

    {{-- Input --}}
    <div class="form-group">
        @if (isset($label))
            <label for="{{ $id }}">
                {{ $label }}
            </label>
        @endif
    
        <input 
            type="file"
            class="form-control"
            @if (isset($id))
                id="{{ $id }}"
            @endif
            @if (isset($name))
                name="{{ $name }}"
            @endif
        >
    </div>
</div>