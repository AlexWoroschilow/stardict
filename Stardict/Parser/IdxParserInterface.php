<?php

namespace Stardict\Parser;

interface IdxParserInterface
{
    /**
     * Find needed word in current block
     * @param string $block
     * @param string $word
     */
    public function find($block = null, $word = null);

    /**
     * Get all words from current block
     * @param string $block
     */
    public function collection($block = null);
    
    /**
     * Get all words from current block
     * @param string $block
     */
    public function count($block = null);
}
