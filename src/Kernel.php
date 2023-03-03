<?php

namespace App;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function buildContainer(): ContainerBuilder
    {
        AnnotationReader::addGlobalIgnoredName("mixin");
        AnnotationReader::addGlobalIgnoredName("alias");
        return parent::buildContainer();
    }
}
