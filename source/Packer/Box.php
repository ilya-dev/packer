<?php namespace Packer;

class Box implements \JsonSerializable {

    protected $source, $destination, $files, $directories;

    /**
     * The constructor.
     *
     * @param string $source
     * @param string $destination
     * @param array $files
     * @param array $directories
     * @return Box
     */
    public function __construct($source, $destination, array $files, array $directories)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->files = $files;
        $this->directories = $directories;
    }

    /**
     * Represent the object as JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $directories = [];

        foreach ($this->directories as $directory)
        {
            $directories[] = [
                'name' => '*.php',
                'in' => $directory
            ];
        }

        return [
            'main' => $this->source,
            'output' => "{$this->destination}.phar",
            'stub' => true,
            'files' => $this->files,
            'finder' => $directories
        ];
    }

}