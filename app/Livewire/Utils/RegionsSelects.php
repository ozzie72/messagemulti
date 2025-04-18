<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class RegionsSelects extends Component
{
    public $countryId = '238';
    public $stateId = '';
    public $cityId = '';
    public $client = '';
    
    public $states = [];
    public $cities = [];
    public $countries = [];

    public function mount($client) {
        $this->client = $client;
        $this->countries =  Country::select('id', 'name')->get();
        $this->states = State::where('country_id', $this->countryId)
        ->select('id', 'name')->get();
    }

    public function updatedCountryId($countryId)
    {
       
        $this->states = State::where('country_id', $countryId)
        ->select('id', 'name')->get();
    }

    public function updatedStateId($stateId)
    {
        if($this->countryId && $stateId) {
            $this->cities = City::where('state_id', $stateId)
            ->select('id', 'name')->get();
        }
        $this->reset('cityId');
    }


}
