<?php

namespace SendGrid;

class Stats
{
    const DATE_FORMAT = 'Y-m-d';

    const OPTIONS_SORT_DIRECTION = ['asc', 'desc'];

    const OPTIONS_AGGREGATED_BY = ['day', 'week', 'month'];

    /**
     * @var string
     */
    private $startDate;

    /**
     * @var string
     */
    private $endDate;

    /**
     * @var string
     */
    private $aggregatedBy;

    /**
     * Stats constructor.
     * @param string $startDate YYYYMMDD
     * @param string $endDate YYYYMMDD
     * @param string $aggregatedBy day|week|month
     */
    public function __construct($startDate, $endDate = null, $aggregatedBy = null)
    {
        $this->validateDateFormat($startDate);
        if (null !== $endDate) {
            $this->validateDateFormat($endDate);
        }
        if (null !== $aggregatedBy) {
            $this->validateOptions('aggregatedBy', $aggregatedBy, self::OPTIONS_AGGREGATED_BY);
        }
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->aggregatedBy = $aggregatedBy;
    }

    /**
     * @return array
     */
    public function getGlobal()
    {
        return [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'aggregated_by' => $this->aggregatedBy
        ];
    }

    /**
     * @param array $categories
     * @return array
     * @throws \Exception
     */
    public function getCategory($categories)
    {
        $this->validateNumericArray('categories', $categories);
        $stats = $this->getGlobal();
        $stats['categories'] = $categories;
        return $stats;
    }

    /**
     * @param array $subusers
     * @return array
     * @throws \Exception
     */
    public function getSubuser($subusers)
    {
        $this->validateNumericArray('subusers', $subusers);
        $stats = $this->getGlobal();
        $stats['subusers'] = $subusers;
        return $stats;
    }

    /**
     * @param string $sortByMetric
     * @param string $sortByDirection asc|desc
     * @param integer $limit
     * @param integer $offset
     * @return array
     * @throws \Exception
     */
    public function getSum($sortByMetric = 'delivered', $sortByDirection = 'desc', $limit = 5, $offset = 0)
    {
        $this->validateOptions('sortByDirection', $sortByDirection, self::OPTIONS_SORT_DIRECTION);
        $this->validateInteger('limit', $limit);
        $this->validateInteger('offset', $offset);
        $stats = $this->getGlobal();
        $stats['sort_by_metric'] = $sortByMetric;
        $stats['sort_by_direction'] = $sortByDirection;
        $stats['limit'] = $limit;
        $stats['offset'] = $offset;
        return $stats;
    }

    /**
     * @param string $subuser
     * @param string $sortByMetric
     * @param string $sortByDirection asc|desc
     * @param integer $limit
     * @param integer $offset
     * @return array
     * @throws \Exception
     */
    public function getSubuserMonthly($subuser = null, $sortByMetric = 'delivered', $sortByDirection = 'desc', $limit = 5, $offset = 0)
    {
        $this->validateOptions('sortByDirection', $sortByDirection, self::OPTIONS_SORT_DIRECTION);
        $this->validateInteger('limit', $limit);
        $this->validateInteger('offset', $offset);
        return [
            'date' => $this->startDate,
            'subuser' => $subuser,
            'sort_by_metric' => $sortByMetric,
            'sort_by_direction' => $sortByDirection,
            'limit' => $limit,
            'offset' => $offset
        ];
    }

    /**
     * @param string $date
     * @throws \Exception
     */
    protected function validateDateFormat($date)
    {
        if (false === \DateTime::createFromFormat(self::DATE_FORMAT, $date)) {
            throw new \Exception('Date must be in the YYYY-MM-DD format.');
        }
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $options
     * @throws \Exception
     */
    protected function validateOptions($name, $value, $options)
    {
        if (!in_array($value, $options)) {
            throw new \Exception($name . ' must be one of: ' . implode(', ', $options));
        }
    }

    /**
     * @param string $name
     * @param integer $value
     * @throws \Exception
     */
    protected function validateInteger($name, $value)
    {
        if (!is_integer($value)) {
            throw new \Exception($name . ' must be an integer.');
        }
    }

    /**
     * @param string $name
     * @param array $value
     * @throws \Exception
     */
    protected function validateNumericArray($name, $value)
    {
        if (!is_array($value) || empty($value) || !$this->isNumeric($value)) {
            throw new \Exception($name . ' must be a non-empty numeric array.');
        }
    }

    /**
     * @param array $array
     * @return bool
     */
    protected function isNumeric(array $array)
    {
        return array_keys($array) == range(0, count($array) - 1);
    }
}
