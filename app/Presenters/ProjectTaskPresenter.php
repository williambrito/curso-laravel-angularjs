<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 21/12/2016
 * Time: 08:56
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectTaskPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectTaskTransformer();
    }
}