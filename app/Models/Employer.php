<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['paycheck'];

    private $parametr;

    public function __construct()
    {
        $this->parametr = Parameter::first();
    }

    public function getPaycheckAttribute()
    {
        // заплата = оклад - НДВЛ
        if ($this->parametr) {

            $personal_income_tax = $this->parametr->personal_income_tax;
            $age_tax = $this->parametr->age_tax;
            $children_tax = $this->parametr->children_tax;
            $car_rent = $this->parametr->car_rent;

            $salary = $this->salary;

            // добавляем налоговую льготу
            if ($this->children > $this->parametr->children_line) {
                $personal_income_tax -= $children_tax;
            }

            // применяем налог и получаем зарплату
            $salary = $salary - $salary * ($personal_income_tax / 100);

            // надбавка к зарплате за возраст
            if ($this->age > $this->parametr->age_line) {
                $salary = $salary + $salary * ($age_tax / 100);
            }

            // аренда из зарплаты за машину
            if ($this->is_car) {
                $salary -= $car_rent;
            }

            return $salary;
        }


        return $this->salary;
    }
}
