<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 10/12/2016
 * Time: 16:15
 */
namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'start_date',
        'due_date',
        'status'
    ];
}
