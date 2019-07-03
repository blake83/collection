<?php declare(strict_types=1);

namespace Comquer\Collection;

final class UniqueIndex
{
    private $getIndex;

    public function __construct(callable $getIndex)
    {
        $this->getIndex = $getIndex;
    }

    public function __invoke($element)
    {
        return ($this->getIndex)($element);
    }

    public function validate($newElement, Collection $elements) : void
    {
        $index = ($this->getIndex)($newElement);
        foreach ($elements as $element) {
            if (($this->getIndex)($element) === $index) {
                throw UniqueIndexException::duplicateIndex($index);
            }
        }
    }
}