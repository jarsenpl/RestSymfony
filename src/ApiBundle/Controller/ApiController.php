<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends FOSRestController
{
    protected function deserialize($class, Request $request, $format = 'json')
    {
        $serializer = $this->get('jms_serializer');
        $validator = $this->get('validator');
        try {
            $entity = $serializer->deserialize($request->getContent(), $class, $format);
        } catch (\RuntimeException $e) {
            throw new \HttpException(400, $e->getMessage());
        }
        if (count($errors = $validator->validate($entity))) {
            return $errors;
        }
        return $entity;
    }
}
