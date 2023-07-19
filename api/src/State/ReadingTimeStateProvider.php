<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Book;

class ReadingTimeStateProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $providerInterface){}
    

    /** @return iterable<int, Book> */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): iterable
    {
        /** @var iterable<int, Book> $books */
        $books = $this->providerInterface->provide($operation, $uriVariables, $context);
        foreach($books as $book){
            $pageCount = $book->getPageCount();
            $book->setReadingTime(2*$pageCount);
    }
    return $books;
}
}