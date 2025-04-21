<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\Divition;
use App\Models\Department;

class DepartmentsSelects extends Component
{
    public $divition_id = '';
    public $department_id = '';
    public $client = '';
    
    public $divitions = [];
    public $departments = [];

    public function mount($client) {
        
        $this->client = $client;
        $this->divitions =  Divition::select('id', 'name')->get();
       
        if($this->client->divition_id) {
            dd($this->client->divition_id == null? 'prueba': 'falso');
            $this->divitionId = $this->client->divition_id;
        }
        if($this->client->department_id) {
            $this->departmentId = $this->client->department_id;
        }
        
    }

    public function updatedDivitionId($divition_id)
    {
        $this->reset(['department_id', 'departments']);
        $this->departments = Department::where('divition_id', $divition_id)
        ->select('id', 'name')->get();
    }


}
