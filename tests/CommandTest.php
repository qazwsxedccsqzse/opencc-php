<?php
/**
 * Created by PhpStorm.
 * User: Wind91@foxmail.com
 * Date: 2019/8/9
 * Time: 13:58
 */

namespace AlphaSnow\OpenCC\Tests;

use AlphaSnow\OpenCC\Command;

class CommandTest extends TestCase
{
    public function provideTestCommandString()
    {
        yield [$this->files.'/traditional.txt', $this->outputs.'/simplified.txt', 't2s.json'];
        yield [$this->files.'/simplified.txt', $this->outputs.'/traditional.txt', 's2t.json'];
    }

    /**
     * @dataProvider provideTestCommandString
     */
    public function testCommandString($input, $output, $config)
    {
        $command = new Command($this->binaryFile, $this->configPath);

        $result = $command
            ->input($input)
            ->output($output)
            ->config($config)
            ->getCommand()
        ;

        $expected = $this->binaryFile.
            ' --input "'.$input.'"'.
            ' --output "'.$output.'"'.
            ' --config "'.$this->configPath.'/'.$config.'"';
        $expected = str_replace('\\', '/', $expected);

        $this->assertEquals($expected, $result);
    }
}
