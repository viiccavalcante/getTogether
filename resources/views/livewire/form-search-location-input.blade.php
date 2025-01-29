<div>
    @include('components.form._form-label')
    <input type="text"  
        wire:model.live.300ms="inputText"  
        placeholder="{{$placeholder}}" 
        class="w-2/3 p-1 rounded-lg border border-gray-200">
    @include('components.form._form-error-handling')
    <input type="hidden" name="{{ $name }}" value="{{ $selectedAddress ? $selectedAddress['description'] : '' }}">

    @if(!empty($suggestedAddresses))
        <ul class="mt-2 bg-white border border-gray-200 rounded-lg shadow-md">
            @foreach($suggestedAddresses as $address)
                <li wire:click="selectAddress({{ json_encode($address) }})" class="p-2 hover:bg-gray-100 cursor-pointer">
                    {{ $address['description'] }}
                </li>
            @endforeach
        </ul>
    @endif
    <br/><br/>
</div>
