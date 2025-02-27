<?php
/**
 * Created by PhpStorm.
 * User: Wind91@foxmail.com
 * Date: 2019/8/9
 * Time: 17:32
 */

namespace qazwsxedccsqzse\OpenCC\Tests;

use qazwsxedccsqzse\OpenCC\Command;
use qazwsxedccsqzse\OpenCC\OpenCC;

class OpenCCTest extends TestCase
{
    public function openCCProvider()
    {
        $command = new Command($this->binaryFile, $this->configPath);
        $openCC = new OpenCC($command);
        return [
            [$openCC]
        ];
    }

    /**
     * @dataProvider openCCProvider
     */
    public function testSimple($openCC)
    {
        $result = $openCC->convert('四面垂杨十里荷。问云何处最花多。画楼南畔夕阳和。', 's2t.json');
        $this->assertSame('四面垂楊十里荷。問云何處最花多。畫樓南畔夕陽和。', $result);
    }

    /**
     * @dataProvider openCCProvider
     */
    public function testTraditional($openCC)
    {
        $result = $openCC->convert('天氣乍涼人寂寞，光陰須得酒消磨。且來花裏聽笙歌。', 't2s');
        $this->assertSame('天气乍凉人寂寞，光阴须得酒消磨。且来花里听笙歌。', $result);
    }
}
