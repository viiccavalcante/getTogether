@include('components.form._form-label')
    <select name="{{$name}}[]" multiple class="w-2/3 p-1 rounded-lg border border-gray-200 @error($name) border-red-500 @enderror">
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" 
                @if(in_array($value, $selectedOptions)) selected @endif class="hover:bg-purple-100">
                {{ $label }}
            </option>
        @endforeach
    </select>
@include('components.form._form-error-handling')
<br/><br/>
