<?php

use PHPUnit\Framework\TestCase;

class GroupByTagTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, groupByTag($input));
    }

    public function positiveDataProvider()
    {
        return [
            [
                [
                    ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
                    ['name' => 'apple', 'tags' => ['fruit', 'green']],
                    ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
                ],
                [
                    'fruit' => ['apple', 'orange'],
                    'green' => ['apple'],
                    'vegetable' => ['potato'],
                    'yellow' => ['potato', 'orange'],
                ]
            ],
            [
                [
                    ['name' => 'Php for the Web: Visual QuickStart Guide', 'tags' => ['php', 'mysql']],
                    ['name' => 'Modern PhP: New Features and Good Practices', 'tags' => ['php']],
                    ['name' => 'Learning php, mysql & JavaScript', 'tags' => ['php', 'mysql', 'javascript']],
                ],
                [
                    'javascript' => [
                        'Learning php, mysql & JavaScript'
                    ],
                    'mysql' => [
                        'Php for the Web: Visual QuickStart Guide',
                        'Learning php, mysql & JavaScript'
                    ],
                    'php' => [
                        'Php for the Web: Visual QuickStart Guide',
                        'Modern PhP: New Features and Good Practices',
                        'Learning php, mysql & JavaScript',
                    ],
                ]
            ],
        ];
    }
}
