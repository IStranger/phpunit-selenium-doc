<?php
/**
 * This class contain common (static) methods
 */

namespace phpdocSeleniumGenerator;

abstract class Helper
{
    /**
     * Strip excess space symbols (spaces, EoL symbols etc.)
     *
     * @param string $sourceText
     * @return string
     */
    static function plainText($sourceText)
    {
        return strtr($sourceText, [
            "\r"              => ' ',
            "\n"              => ' ',
            "\t"              => ' ',
            '               ' => ' ',
            '              '  => ' ',
            '             '   => ' ',
            '            '    => ' ',
            '           '     => ' ',
            '          '      => ' ',
            '         '       => ' ',
            '        '        => ' ',
            '       '         => ' ',
            '      '          => ' ',
            '     '           => ' ',
            '    '            => ' ',
            '   '             => ' ',
            '  '              => ' ',
        ]);
    }
}