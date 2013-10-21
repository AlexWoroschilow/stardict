<?php
namespace Stardict\Compressor;

interface CompressorInterface
{
    /**
     * Uncompress data from package
     * @param string $path
     */
    public function uncompress($path = null, $callback = null);
    
    /**
     * Compress data to package
     * @param string $path
     */
    public function compress($path = null);
    
}
