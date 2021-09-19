<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Brick\Math;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition()
    {
    	return [
    	    //
            'title'=>$this->faker->text,
            'description'=>$this->faker->paragraph,
            'user_id'=>random_int(1,10)
    	];
    }
}
