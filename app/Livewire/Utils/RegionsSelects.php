<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class RegionsSelects extends Component
{
    public $country_id = '238';
    public $state_id = "";
    public $city_id = "";
    public $client = "";
    
    public $states = [];
    public $cities = [];
    public $countries = [];

    public function mount($client) {
        $this->client = $client;
        $this->countries =  Country::select('id', 'name')->get();
        $this->states = State::where('country_id', $this->country_id)
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
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
        ];
    }


    public function updatedCountryId($country_id)
    {
        $this->reset(['state_id', 'city_id', 'states', 'cities']);
        $this->countries =  Country::select('id', 'name')->get();
        $this->states = State::where('country_id', $country_id)
        ->select('id', 'name')->get();
       
    }

    public function updatedStateId($state_id)
    {
        $this->reset(['city_id', 'cities']);
        if($this->country_id && $state_id) {
            $this->states = State::where('country_id', $this->country_id)
            ->select('id', 'name')->get();
            $this->cities = City::where('state_id', $state_id)
            ->select('id', 'name')->get();
        }
       
    }

    public function render()
    {
        return view('livewire.utils.regions-selects');
    }



}
