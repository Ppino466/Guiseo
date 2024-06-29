<?php

namespace App\Http\Livewire\Goal;

use App\Models\Goal;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

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
    public $selectedUser;
    public $statusGoal;

    protected $listeners = ['editGoal' => 'editGoal', 'downGoal' => 'downGoal', 'upGoal' => 'upGoal','deleteGoal'=> 'deleteGoal'];

    public function messages(): array
    {
        return [
            'selectedUser.required' => 'El empleado es requerido',
            'type.required' => 'El tipo es requerido',
            'amount.required' => 'La cantidad es requerida',
            'startDate.required' => 'La fecha de inicio es requerida', 
            'endDate.required' => 'La fecha de fin es requerida',
            'description.required' => 'La descripicón es requerida',
        ];
    }
    

     public function saveGoal()
     {
         $symbols = array("$", ",");
         $this->validate([
             'selectedUser' => 'required',
             'type' => 'required',
             'amount' => 'required',
             'startDate' => 'required',
             'endDate' => 'required',
             'description' => 'required',
         ]);
 
         Goal::create ([
             'user_id' => $this->selectedUser,
             'type' => $this->type,
             'amount' =>  str_replace($symbols, '', $this->amount),
             'start_date' => $this->startDate,
             'end_date' => $this->endDate,
             'description' => $this->description,
             'status' => 'pending'
         ]);
 
         $this->emit('goalCreated');
         $this->emit('refreshDatatable');
 
     }
     
    public function downGoal($goalId) 
    {
        $goal = Goal::findOrFail($goalId);

        if($goal){
            $goal->status = 'pending';
            $goal->save();
            $this->emit('refreshDatatable');
        }
    }

    public function upGoal($goalId) 
    {
        $goal = Goal::findOrFail($goalId);

        if($goal){
            $goal->status = 'active';
            $goal->save();
            $this->emit('refreshDatatable');
        }
    }

    public function editGoal($goalId)
    {
        if ($goalId) {
          
            $this->goal = Goal::find($goalId);
            if ($this->goal) {
          
                $user = User::find($this->goal->user_id);
    
                if ($user) {
                    $this->userId = $user->name;
                } else {
                    $this->userId = "Unknown User";
                }
                
                $this->type = $this->goal->type;
                $this->amount = $this->goal->amount;
                $this->startDate = $this->goal->start_date;
                $this->endDate = $this->goal->end_date;
                $this->description = $this->goal->description;
                $this->statusGoal = $this->goal->status;
    
            } else {
                $this->resetGoalAttributes();
            }
        } else {
            $this->resetGoalAttributes();
        }
    }
    
    private function resetGoalAttributes()
    {
        $this->userId = "";
        $this->type = "";
        $this->amount = "";
        $this->startDate = "";
        $this->endDate = "";
        $this->description = "";
        $this->statusGoal ="";
    }
    
    public function updateGoal()
    {
        $this->validate([
            'type' => 'required',
            'amount' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'description' => 'required',
        ]);

        $symbols = array("$", ",");
        $this->goal->type = $this->type;
        $this->goal->amount =  str_replace($symbols, '', $this->amount);
        $this->goal->start_date = $this->startDate;
        $this->goal->end_date = $this->endDate;
        $this->goal->description = $this->description;
        $this->goal->save();

        $this->emit('goalUpdated');
        $this->emit('refreshDatatable');
    }

    public function deleteGoal($goalId) 
    {
        Goal::destroy($goalId);
        $this->emit('refreshDatatable');
    }

    public function updatedType($value)
    {
        if ($this->startDate) {
            $startDate = Carbon::createFromFormat('Y-m-d', $this->startDate);
            $endDate = $startDate->copy();

            switch ($this->type) {
                case 'Quincena':
                    $endDate->addDays(15);
                    break;
                case 'Mensual':
                    $endDate->addMonth();
                    break;
                case 'Cuatrimestral':
                    $endDate->addMonths(4);
                    break;
                default:
                    $endDate->addDays(30);
                    break;
            }

            $this->endDate = $endDate->format('Y-m-d');
        }
    }

    public function mount() 
    {
        $this->listUser = User::select('id', 'name')->get();    
    }

    public function render()
    {
        return view('livewire.goal.goal-modal');
    }
}
