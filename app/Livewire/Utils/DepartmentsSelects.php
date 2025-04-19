<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\Divition;
use App\Models\Department;

class DepartmentsSelects extends Component
{
    public $divitionId = '';
    public $departmentId = '';
    public $client = '';
    
    public $divitions = [];
    public $departments = [];

    public function mount($client) {
        
        $this->client = $client;
        $this->divitions =  Divition::select('id', 'name')->get();
        if($this->client?->divition_id) {
            $this->divitionId = $this->client->divition_id;
        }
        if($this->client?->department_id) {
            $this->departmentId = $this->client->department_id;
        }
        
    }

    public function updatedDivitionId($divitionId)
    {
       
        $this->departments = Department::where('divition_id', $divitionId)
        ->select('id', 'name')->get();
    }


}
