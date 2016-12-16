<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 16/12/2016
 * Time: 10:56
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectFileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectFilePresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectFileTransformer();
    }
}