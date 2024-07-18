<?php

namespace App\Services;

use DB;

class MatcherService
{
    public function match(int $propertyId): array
    {
        $query = $this->buildMatchQuery();

        // Executing the query
        $matchesObjects = DB::select($query, ['propertyId' => $propertyId]);
        $matchesArray = $this->convertObjectsToArray($matchesObjects);

        return $matchesArray;
    }

    /**
     * Build the main match query.
     *
     * @param string $directExactCondition
     * @param string $directRangeCondition
     * @param string $looseRangeCondition
     * @return string
     */
    private function buildMatchQuery(): string
    {
        $directExactCondition = $this->buildDirectExactCondition();
        $directRangeCondition = $this->buildDirectRangeCondition();
        $looseRangeCondition = $this->buildLooseRangeCondition();
        $missMatchingCondition = $this->buildMissMatchingCondition();
        return "
        SELECT
            search_profiles.id AS searchProfileId,
            SUM(
                CASE
                    WHEN $directExactCondition THEN 1
                    WHEN $directRangeCondition THEN 1
                    ELSE 0
                END
            ) AS strictMatchesCount,
            SUM(
                CASE
                    WHEN !($directRangeCondition) AND ($looseRangeCondition) THEN 1
                    ELSE 0
                END
            ) AS looseMatchesCount,
            SUM(
                CASE
                    WHEN $directExactCondition THEN 2
                    WHEN $directRangeCondition THEN 2
                    WHEN $looseRangeCondition THEN 1
                    ELSE 0
                END
            ) AS match_score,
            sum(case when  $missMatchingCondition then 1 ELSE 0 end)
                missing_match
        FROM
            search_profiles
        JOIN
            properties ON properties.property_type = search_profiles.property_type
        JOIN
            property_fields ON properties.id = property_fields.property_id
        JOIN
            search_profile_fields ON search_profiles.id = search_profile_fields.search_profile_id
        WHERE
            properties.id = :propertyId
        GROUP BY
            search_profiles.id
        HAVING
            match_score > 0 and missing_match = 0
        ORDER BY
            match_score DESC;
    ";
    }

    /**
     * Build the condition for direct exact matches.
     *
     * @return string
     */
    private function buildDirectExactCondition(): string
    {
        return "search_profile_fields.field_type = 'direct' AND property_fields.field_name = search_profile_fields.field_name AND property_fields.field_value = search_profile_fields.exact_value";
    }

    /**
     * Build the condition for direct exact matches.
     *
     * @return string
     */
    private function buildMissMatchingCondition(): string
    {
        return "( search_profile_fields.field_type = 'direct' AND
        property_fields.field_name = search_profile_fields.field_name AND
        property_fields.field_value != search_profile_fields.exact_value AND
        property_fields.field_name is not null AND
        search_profile_fields.exact_value is not null ) OR

        (search_profile_fields.field_type = 'range' AND property_fields.field_name = search_profile_fields.field_name AND (
           (search_profile_fields.min_range_value IS NOT NULL AND search_profile_fields.max_range_value IS NOT NULL AND
               property_fields.field_value NOT BETWEEN (search_profile_fields.min_range_value * 0.75) AND (search_profile_fields.max_range_value * 1.25))
           OR
           (search_profile_fields.min_range_value IS NULL AND property_fields.field_value > (search_profile_fields.max_range_value * 1.25))
           OR
           (search_profile_fields.max_range_value IS NULL AND property_fields.field_value < (search_profile_fields.min_range_value * 0.75))
        ))

        ";


    }

    /**
     * Build the condition for direct range matches.
     *
     * @return string
     */
    private function buildDirectRangeCondition(): string
    {
        return "search_profile_fields.field_type = 'range' AND
                property_fields.field_name = search_profile_fields.field_name AND(
                (search_profile_fields.min_range_value IS NOT NULL AND search_profile_fields.max_range_value IS NOT NULL AND
                    property_fields.field_value BETWEEN search_profile_fields.min_range_value AND search_profile_fields.max_range_value)
                OR
                (search_profile_fields.min_range_value IS NULL AND property_fields.field_value <= search_profile_fields.max_range_value)
                OR
                (search_profile_fields.max_range_value IS NULL AND property_fields.field_value >= search_profile_fields.min_range_value)
                OR
                ( search_profile_fields.min_range_value IS NULL AND search_profile_fields.max_range_value IS NULL)
            )";
    }

    /**
     * Build the condition for loose range matches.
     *
     * @return string
     */
    private function buildLooseRangeCondition(): string
    {
        return "search_profile_fields.field_type = 'range' AND property_fields.field_name = search_profile_fields.field_name AND (
                (search_profile_fields.min_range_value IS NOT NULL AND search_profile_fields.max_range_value IS NOT NULL AND
                    property_fields.field_value BETWEEN (search_profile_fields.min_range_value * 0.75) AND (search_profile_fields.max_range_value * 1.25))
                OR
                (search_profile_fields.min_range_value IS NULL AND property_fields.field_value <= (search_profile_fields.max_range_value * 1.25))
                OR
                (search_profile_fields.max_range_value IS NULL AND property_fields.field_value >= (search_profile_fields.min_range_value * 0.75))
            )";
    }



    /**
     * Convert the objects returned from the query to an array.
     *
     * @param array $matchesObjects
     * @return array
     */
    private function convertObjectsToArray(array $matchesObjects): array
    {
        return collect($matchesObjects)->map(function ($item) {
            return (array)$item;
        })->toArray();
    }

}
