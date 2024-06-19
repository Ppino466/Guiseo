<?php

namespace App\Http\Livewire\Goal;

use App\Models\Goal;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class GoalModal extends Component
{

    public $listUser;
    public $goal;
    public $userId;
    public $type;
    public $amount;
    public $startDate;
    public $endDate;
    public $description;
    
    protected $listeners = ['editGoal' => 'editGoal','downUser' => 'downUser','upUser'=> 'upUser'];
   
    public function editGoal($userId)
    {
        $this->userId = User::find($userId)->name;
        if($userId){
            $this->goal = Goal::find($userId);
            $this->type = $this->goal->type;
            $this->amount = $this->goal->amount; 
            $this->startDate = $this->goal->start_date;
            $this->endDate = $this->goal->end_date;
            $this->description = $this->goal->description;
        }

    }

    public function updateGoal () 
    {
       $this->validate([
        'type' => 'required',
        'amount' => 'required',
        'startDate' => 'required',
        'endDate' => 'required',
        'description' => 'required',
       ]);
       
            $symbols = array("$",",");    
            $this->goal->type = $this->type;
            $this->goal->amount =  str_replace($symbols, '', $this->amount); 
            $this->goal->start_date = $this->startDate;
            $this->goal->end_date = $this->endDate;
            $this->goal->description = $this->description;
            $this->goal->save();
            //dd($this->goal->end_date);
      $this->emit('goalUpdated');
      $this->emit('refreshDatatable');

    }

    public function render()
    {
        return view('livewire.goal.goal-modal');
    }
}
