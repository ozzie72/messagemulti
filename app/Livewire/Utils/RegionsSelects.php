<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class RegionsSelects extends Component
{
    public $countryId = '238';
    public $stateId = "";
    public $cityId = "";
    public $client = "";
    
    public $states = [];
    public $cities = [];
    public $countries = [];

    public function mount($client) {
        $this->client = $client;
        $this->countries =  Country::select('id', 'name')->get();
        $this->states = State::where('country_id', $this->countryId)
        ->select('id', 'name')->get();
        if( $this->client?->state_id){
            $this->stateId = $this->client->state_id;
        }
        if( $this->client?->city_id){
           
            $this->cities = City::where('state_id', $this->client->state_id)
            ->select('id', 'name')->get();
            
            $this->cityId = $this->client->city_id;
        }
    }

    public function rules(): array {
        return [
            'countryId' => 'required|exists:countries,id',
            'stateId' => 'required|exists:states,id',
            'cityId' => 'required|exists:cities,id',
        ];
    }


    public function updatedCountryId($countryId)
    {
        $this->reset(['stateId', 'cityId', 'states', 'cities']);
        
        $this->states = State::where('country_id', $countryId)
        ->select('id', 'name')->get();
       
    }

    public function updatedStateId($stateId)
    {
        $this->reset(['cityId', 'cities']);
        if($this->countryId && $stateId) {
            $this->cities = City::where('state_id', $stateId)
            ->select('id', 'name')->get();
        }
       
    }


}
