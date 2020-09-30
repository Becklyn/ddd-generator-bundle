<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\MultiClass;

use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;

interface MultipleClassesMaker
{
    /**
     * Returns a list of Makers that are to be generated
     *
     * @return AbstractMaker[]
     */
    public function getMakers () : array;
}
