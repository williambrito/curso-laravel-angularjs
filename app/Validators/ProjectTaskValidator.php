<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 10/12/2016
 * Time: 16:15
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required',
        'start_date' => 'required',
        'due_date' => 'required',
        'status' => 'required'
    ];
}