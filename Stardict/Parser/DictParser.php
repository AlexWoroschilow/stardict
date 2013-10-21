<?php

namespace Stardict\Parser;

use Stardict\Model\Dict;
use Stardict\Model\IdxInterface;
use Stardict\Parser\DictParserInterface;

class DictParser implements DictParserInterface
{
    /**
     * Find translation
     * @param string $block
     * @param Idx $model
     */
    public function find($block = null, IdxInterface $model = null)
    {
        return $this->parse($block, $model);
    }

    /**
     * Parse block and find translation
     * @param int $block
     * @param int $model
     */
    protected function parse ($block = null, $model = null)
    {
        $entity = new Dict();
        $entity->setText(substr($block, $model->getStart(), $model->getLength()));
        
        return $entity;
    }
}
