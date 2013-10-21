<?php

namespace Stardict\Parser;

use Stardict\Model\IdxInterface;

interface DictParserInterface
{
    /**
     * Find needed word in current block
     * @param string $block
     * @param string $word
     */
    public function find($block = null, IdxInterface $model);
}