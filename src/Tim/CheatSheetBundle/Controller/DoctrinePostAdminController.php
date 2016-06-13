<?php

namespace Tim\CheatSheetBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class DoctrinePostAdminController extends CRUDController
{
    public function createPDFAction($id = null)
    {
        $request = $this->getRequest();

        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->admin->checkAccess('edit', $object);

//       // todo: add method realisation
    }
}
