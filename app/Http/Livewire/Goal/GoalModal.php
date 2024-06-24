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

    protected $listeners = ['editGoal' => 'editGoal', 'downGoal' => 'downGoal', 'upGoal' => 'upGoal','deleteGoal'=> 'deleteGoal'];

    /* public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'lastName.required' => 'El apellido es requerido',
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo electrónico debe ser válido', 
            'phone.required' => 'El teléfono es requerido',
        ];
    }
     */

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
     
    public function showGoal($goalId)
    {
        if ($goalId) {
      //      $this->userId = User::find($userId)->name;
            $this->goal = Goal::find($goalId);
            $this->type = $this->goal->type;
            $this->amount = $this->goal->amount;
            $this->startDate = $this->goal->start_date;
            $this->endDate = $this->goal->end_date;
            $this->description = $this->goal->description;
        }
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

    public function editGoal($userId)
    {
        
        if ($userId) {
            $this->userId = User::find($userId)->name;
            $this->goal = Goal::find($userId);
            $this->type = $this->goal->type;
            $this->amount = $this->goal->amount;
            $this->startDate = $this->goal->start_date;
            $this->endDate = $this->goal->end_date;
            $this->description = $this->goal->description;
        } else {
            $this->amount = "";
            $this->startDate = "";
            $this->endDate = "";
            $this->description = "";
        }
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
