<?php

namespace PiedWeb\ContactBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use PiedWeb\ContactBundle\DependencyInjection\PiedWebContactExtension;

class PiedWebContactBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new PiedWebContactExtension();
        }

        return $this->extension;
    }
}
