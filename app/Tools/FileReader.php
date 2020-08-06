<?php

namespace App\Tools;

use Closure;

class FileReader
{
    protected $filename;

    protected $size;

    protected $nbLines;

    protected $rows = [];

    /**
     * CsvReader constructor.
     *
     * @param $filename
     * @param int $size
     */
    public function __construct($filename, $size = 4096)
    {
        $this->filename = $filename;
        $this->size = $size;
    }

    /**
     * @param null $nbLines
     * @return array
     */
    public function rows($nbLines = null)
    {
        $this->nbLines = $nbLines;

        $this->resetRows();
        foreach ($this->generator() as $row) {
            $this->rows[] = trim($row);
        }

        return $this->rows;
    }

    /**
     * Undocumented function
     *
     * @param Closure $func
     * @param [type] $max
     * @return void
     */
    public function each(Closure $func, $max = null)
    {
        $this->nbLines = $max;

        foreach ($this->generator() as $row) {
            $func(str_replace(PHP_EOL, null, $row));
        }
    }

    /**
     * @return \Generator
     */
    protected function generator()
    {
        $handle = fopen($this->filename, 'r');

        $row = 0;
        while (!feof($handle)) {

            if($this->nbLines && $row == $this->nbLines) {
                break;
            }

            yield fgets($handle, $this->size);
            $row++;
        }

        fclose($handle);
    }

    /**
     *
     */
    protected function resetRows()
    {
        $this->rows = [];
    }
}
