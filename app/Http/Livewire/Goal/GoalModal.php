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
    public $star_date;
    public $end_date;
    public $description;

    protected $listeners = ['editGoal' => 'editGoal','downUser' => 'downUser','upUser'=> 'upUser'];
   
    public function editGoal($userId)
    {
        if($userId){
            $this->goal = Goal::find($userId);
            $this->type = $this->goal->type;
            $this->amount = $this->goal->amount; 
        }
    }

    public function mount()
    {

        $role = Role::where('name', 'Vendedor')->first();

        $this->listUser = User::role($role->name)->select('id', 'name')->get();

    }

    public function render()
    {
        return view('livewire.goal.goal-modal');
    }
}
