<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 22/12/2016
 * Time: 10:23
 */

namespace CodeProject\Presenters;


use CodeProject\Transformers\ProjectMemberTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectMemberPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectMemberTransformer();
    }
}