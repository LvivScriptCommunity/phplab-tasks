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
                    'yellow' => ['orange', 'potato'],
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
                        'Learning php, mysql & JavaScript',
                        'Php for the Web: Visual QuickStart Guide',
                    ],
                    'php' => [
                        'Learning php, mysql & JavaScript',
                        'Modern PhP: New Features and Good Practices',
                        'Php for the Web: Visual QuickStart Guide',
                    ],
                ]
            ],
        ];
    }
}