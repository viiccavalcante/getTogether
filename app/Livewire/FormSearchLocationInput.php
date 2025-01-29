<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\LocationService;

class FormSearchLocationInput extends Component
{
    public $inputText = '';
    public ?string $placeholder = null;
    public string $label;
    public string $name;
    public $suggestedAddresses = [];
    public $selectedAddress = null;

    protected $locationService;

    public function boot(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function updatedInputText()
    {
        $this->selectedAddress = null;
        if (strlen($this->inputText) > 2) {
            $this->suggestedAddresses = $this->locationService->getLocation($this->inputText);
        } else {
            $this->suggestedAddresses = [];
        }
    }

    public function selectAddress($address)
    {
        $this->selectedAddress = $address;
        $this->inputText = $address['description'];
        $this->suggestedAddresses = [];
    }

    public function render()
    {      
        return view('livewire.form-search-location-input');
    }
}
