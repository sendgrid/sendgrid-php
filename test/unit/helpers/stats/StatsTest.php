<?php
namespace SendGrid;

use SendGridPhp\Tests\BaseTestClass;

class StatsTest extends BaseTestClass
{
    /**
     * @param array $expectedGlobal
     * @param array $expectedCategory
     * @param array $expectedSubuser
     * @param array $expectedSum
     * @param array $expectedSubuserMonthly
     * @dataProvider validValues
     */
    public function testGetValues(
        $expectedGlobal,
        $expectedCategory,
        $expectedSubuser,
        $expectedSum,
        $expectedSubuserMonthly
    ) {
        $userStats = new Stats($expectedGlobal['start_date'], $expectedGlobal['end_date'], $expectedGlobal['aggregated_by']);
        $this->assertEquals($expectedGlobal, $userStats->getGlobal());
        $this->assertEquals($expectedCategory, $userStats->getCategory($expectedCategory['categories']));
        $this->assertEquals($expectedSubuser, $userStats->getSubuser($expectedSubuser['subusers']));
        $this->assertEquals($expectedSum, $userStats->getSum(
            $expectedSum['sort_by_metric'],
            $expectedSum['sort_by_direction'],
            $expectedSum['limit'],
            $expectedSum['offset']
        ));
        $this->assertEquals($expectedSubuserMonthly, $userStats->getSubuserMonthly(
            $expectedSubuserMonthly['subuser'],
            $expectedSubuserMonthly['sort_by_metric'],
            $expectedSubuserMonthly['sort_by_direction'],
            $expectedSubuserMonthly['limit'],
            $expectedSubuserMonthly['offset']
        ));
    }

    /**
     * @param array $expectedGlobal
     * @param array $expectedCategory
     * @param array $expectedSubuser
     * @param array $expectedSum
     * @param array $expectedSubuserMonthly
     * @dataProvider invalidValues
     * @expectedException Exception
     */
    public function testGetValuesFail(
        $expectedGlobal,
        $expectedCategory,
        $expectedSubuser,
        $expectedSum,
        $expectedSubuserMonthly
    ) {
        $this->testGetValues(
            $expectedGlobal,
            $expectedCategory,
            $expectedSubuser,
            $expectedSum,
            $expectedSubuserMonthly
        );
    }

    public function validValues()
    {
        return [
            [
                $this->getExpectedGlobal('1980-01-01', null, null),
                $this->getExpectedCategory('1980-01-01', null, null, ['cat1', 'cat2']),
                $this->getExpectedSubuser('1980-01-01', null, null, ['user1', 'user2']),
                $this->getExpectedSum('1980-01-01', null, null, 'delivered', 'desc', 5, 0),
                $this->getExpectedSubuserMonthly('1980-01-01', 'user1', 'delivered', 'desc', 5, 0),
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', null),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', null, ['cat1']),
                $this->getExpectedSubuser('1980-01-01', '2017-01-01', null, ['user1']),
                $this->getExpectedSum('1980-01-01', '2017-01-01', null, 'delivered', 'asc', 10, 2),
                $this->getExpectedSubuserMonthly('1980-01-01', 'user1', 'delivered', 'asc', 10, 2),
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', ['cat1']),
                $this->getExpectedSubuser('1980-01-01', '2017-01-01', 'day', ['user1']),
                $this->getExpectedSum('1980-01-01', '2017-01-01', 'day', 'delivered', 'asc', 50, 6),
                $this->getExpectedSubuserMonthly('1980-01-01', 'user1', 'delivered', 'asc', 50, 6),
            ],
        ];
    }

    public function invalidValues()
    {
        return [
            [
                $this->getExpectedGlobal(null, null, null),
                null,
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-0145', null, null),
                null,
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '1980-01-0145', null),
                null,
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '1980-01-02', 'asdf'),
                null,
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', null),
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', null),
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', []),
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', ['a' => 'b']),
                null,
                null,
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', ['cat1']),
                $this->getExpectedSubuser('1980-01-01', '2017-01-01', 'day', null),
                $this->getExpectedSum('1980-01-01', '2017-01-01', 'day', 'delivered', null, 50, 6),
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', ['cat1']),
                $this->getExpectedSubuser('1980-01-01', '2017-01-01', 'day', null),
                $this->getExpectedSum('1980-01-01', '2017-01-01', 'day', 'delivered', 'asdf', 50, 6),
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', ['cat1']),
                $this->getExpectedSubuser('1980-01-01', '2017-01-01', 'day', null),
                $this->getExpectedSum('1980-01-01', '2017-01-01', 'day', 'delivered', 'asc', null, 'asdf'),
                null
            ],
            [
                $this->getExpectedGlobal('1980-01-01', '2017-01-01', 'day'),
                $this->getExpectedCategory('1980-01-01', '2017-01-01', 'day', ['cat1']),
                $this->getExpectedSubuser('1980-01-01', '2017-01-01', 'day', ['user1']),
                $this->getExpectedSum('1980-01-01', '2017-01-01', 'day', 'delivered', 'asc', 50, 6),
                $this->getExpectedSubuserMonthly('1980-01-01', 'user1', 'delivered', 'asc', 50, null),
            ],
        ];
    }

    public function getExpectedGlobal($startDate, $endDate, $aggregatedBy)
    {
        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'aggregated_by' => $aggregatedBy,
        ];
    }

    public function getExpectedCategory($startDate, $endDate, $aggregatedBy, $categories)
    {
        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'aggregated_by' => $aggregatedBy,
            'categories' => $categories
        ];
    }

    public function getExpectedSubuser($startDate, $endDate, $aggregatedBy, $subusers)
    {
        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'aggregated_by' => $aggregatedBy,
            'subusers' => $subusers
        ];
    }

    public function getExpectedSum($startDate, $endDate, $aggregatedBy, $sortByMetric, $sortByDirection, $limit, $offset)
    {
        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'aggregated_by' => $aggregatedBy,
            'sort_by_metric' => $sortByMetric,
            'sort_by_direction' => $sortByDirection,
            'limit' => $limit,
            'offset' => $offset
        ];
    }

    public function getExpectedSubuserMonthly($date, $subuser, $sortByMetric, $sortByDirection, $limit, $offset)
    {
        return [
            'date' => $date,
            'subuser' => $subuser,
            'sort_by_metric' => $sortByMetric,
            'sort_by_direction' => $sortByDirection,
            'limit' => $limit,
            'offset' => $offset
        ];
    }
}
