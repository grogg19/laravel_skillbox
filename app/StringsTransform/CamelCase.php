<?php


namespace App\StringsTransform;

/**
 * Class CamelCase
 * @package App\StringsTransform
 */
class CamelCase
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var bool
     */
    private $flag;

    /**
     * CamelCase constructor.
     * @param string $string
     * @param bool $flag
     */
    public function __construct(string $string, bool $flag = false)
    {
        $this->string = $string;
        $this->flag = $flag;
    }

    /**
     * трансформирует строку в CaMelCaSe
     * @return string
     */
    public function transform(): string
    {
        $result = '';

        foreach (str_split($this->string) as $key => $letter) {
            if($letter === ' ') {
                $result .= ' ';
                continue;
            }

            $result .= $this->flag === true ? mb_strtolower($letter) : mb_strtoupper($letter);

            $this->flag = !($this->flag === true);

        }
        return $result;
    }
}
