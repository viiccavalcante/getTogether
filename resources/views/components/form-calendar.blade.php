@include('components.form._form-label')
<div class="mb-4">
    <input type="{{ $type ?? 'text' }}"  name="{{$name}}" 
        class="w-2/3 p-1 rounded-lg border border-gray-200 @error($name) border-red-500 @enderror"
        min="{{ \Carbon\Carbon::today()->toDateString() }}" 
        {{ $attributes }}
    />
</div>

@include('components.form._form-error-handling')