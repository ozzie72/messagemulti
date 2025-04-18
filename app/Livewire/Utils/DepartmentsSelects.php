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
        
    }

    public function updatedDivitionId($divitionId)
    {
       
        $this->departments = Department::where('divition_id', $divitionId)
        ->select('id', 'name')->get();
    }


}
