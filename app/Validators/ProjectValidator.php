<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 01/12/2016
 * Time: 16:15
 */

namespace CodeProject\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'owner_id' => 'required|integer',
            'client_id' => 'required|integer',
            'name' => 'required',
            'progress' => 'required',
            'status' => 'required',
            'due_date' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'client_id' => 'required|integer',
            'name' => 'required',
            'progress' => 'required',
            'status' => 'required',
            'due_date' => 'required'
        ]
    ];
}