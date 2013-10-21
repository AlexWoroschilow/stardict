<?php
namespace Stardict\Compressor;
use Stardict\Compressor\CompressorInterface;

class GzfileCompressor implements CompressorInterface
{

    /**
     * Uncompress data from package
     * @param string $path
     */
    public function uncompress($path = null, $callback = null)
    {
        ob_start();
        readgzfile($path);
        $result = ob_get_clean();
        if ($callback instanceof \Closure) {
            return call_user_func_array($callback, array($result));
        }
        return $result;
    }

    /**
     * Compress data to package
     * @param string $path
     */
    public function compress($path = null)
    {
        throw new \Exception("No implemented yet!");
    }
}
