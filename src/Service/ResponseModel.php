<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class ResponseModel
{
    /** @var EntityManagerInterface */
    private $manager;

    /** @var array */
    private $data;

    /** @var int */
    private $statusCode;

    public function __construct(EntityManagerInterface $manager)
    {
        //TODO: Change this to use setter for dep injection instead
        $this->manager = $manager;
    }

    /**
     * @param string $className
     *
     * @return ResponseModel
     */
    public function createFromClassName($className)
    {
        $data = $this->manager->getRepository($className)->findAll();
        $this->setData($data ?? []);
        $this->setStatusCode(200);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return ResponseModel
     */
    public function setData($data): ResponseModel
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return ResponseModel
     */
    public function setStatusCode(int $statusCode): ResponseModel
    {
        $this->statusCode = $statusCode;
        return $this;
    }


}