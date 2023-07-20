<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Book;
use DateTime;

class AdditionDateStateProcessor implements ProcessorInterface
{
    public function __construct(private ProcessorInterface $processorInterface)
    {
        
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if($data instanceof Book){
            $data->setAdditionDate(new DateTime());
        }
        $processedData = $this->processorInterface->process($data, $operation, $uriVariables, $context);
    }
}
