<?php

use App\Services\MatcherService;
use App\Services\PropertyService;
use App\Services\SearchProfileService;
use Tests\TestCase;

class MatcherTest extends TestCase
{
    public function test_one_input_one_result_direct_found(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["heatingType" => "gas"], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["heatingType" => "gas"], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals($response[0]['searchProfileId'], $searchProfile->id);
    }

    public function test_one_input_one_result_direct_not_found(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["heatingType" => "electric"], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["heatingType" => "gas"], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response), 0);
    }

    public function test_one_input_one_result_range_no_null_found(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 25000],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" =>  [50000,100000]],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);


        //Assertion
        $this->assertEquals(count($response ) ,0  );
    }


    public function test_one_input_one_result_range_no_null_not_found(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 25000],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" =>  [50000,10000]],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);

        //Assertion
        $this->assertEquals(count($response ) ,0  );

    }

    public function test_one_input_one_result_range_null_on_left_found(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 150000], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [null, 200000]], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals($response[0]['searchProfileId'], $searchProfile->id);
    }

    public function test_one_input_one_result_range_null_on_left_not_found(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 300000], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [null, 200000]], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response), 0);
    }


    public function test_one_input_one_result_range_null_on_right_found(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 75000],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" =>  [50000,null]],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);

        //Assertion
        $this->assertEquals($response[0]['searchProfileId'] ,$searchProfile->id  );
        $this->assertEquals($response[0]['strictMatchesCount'] ,1 );
        $this->assertEquals($response[0]['looseMatchesCount'] ,0 );
    }
    public function test_one_input_one_result_range_null_on_right_not_found(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 100000], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [200000, null]], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response), 0);
    }

    public function test_one_input_one_result_range_no_null_loose_found(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 40000],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" =>  [50000,100000]],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);


        //Assertion
        $this->assertEquals($response[0]['searchProfileId'] ,$searchProfile->id  );
        $this->assertEquals($response[0]['strictMatchesCount'] ,0 );
        $this->assertEquals($response[0]['looseMatchesCount'] ,1 );
    }
    public function test_one_input_one_result_range_null_on_left_loose_found(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 250000], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [null, 200000]], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals($response[0]['searchProfileId'] ,$searchProfile->id  );
        $this->assertEquals($response[0]['strictMatchesCount'] ,0 );
        $this->assertEquals($response[0]['looseMatchesCount'] ,1 );
    }
    public function test_one_input_one_result_range_null_on_right_loose_found(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 40000],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" =>  [50000,null]],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);

        //Assertion
        $this->assertEquals($response[0]['searchProfileId'] ,$searchProfile->id  );
        $this->assertEquals($response[0]['strictMatchesCount'] ,0 );
        $this->assertEquals($response[0]['looseMatchesCount'] ,1 );
    }

    public function test_null_input(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => [],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" =>  [50000,null]],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);

        //Assertion
        $this->assertEquals(count($response), 0);
    }

    public function test_null_result(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ['price'=>200000],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => [],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);

        //Assertion
        $this->assertEquals(count($response), 0);
    }
    public function test_null_input_null_result(): void
    {
        //Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => [],'propertyType'=>$uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => [],'propertyType'=>$uniqueType]);

        //Action
        $response = (new MatcherService())->match($property->id);

        //Assertion
        $this->assertEquals(count($response), 0);
    }



    public function test_result_found_with_multiple_matching_profiles(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => "1500000", "area" => "180"], 'propertyType' => $uniqueType]);
        $searchProfile1 = $this->createSearchProfile(["searchFields" => ["price" => ["0", "2000000"]], 'propertyType' => $uniqueType]);
        $searchProfile2 = $this->createSearchProfile(["searchFields" => ["area" => ["150", null]], 'propertyType' => $uniqueType]);
        $searchProfile3 = $this->createSearchProfile(["searchFields" => ["price" => ["0", "1000000"]], 'propertyType' => $uniqueType]);


        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response), 2);
        $this->assertContains($searchProfile1->id, array_column($response, 'searchProfileId'));
        $this->assertContains($searchProfile2->id, array_column($response, 'searchProfileId'));
        $this->assertNotContains($searchProfile3->id, array_column($response, 'searchProfileId'));
    }



    public function test_missmatch_direct(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 150000, "area" => 200], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [100000, 200000], "area" => 150], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response), 0);
    }

    public function test_missmatch_range(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 150000, "area" => 200], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [100000, 200000], "area" => [100,150] ], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response), 0);
    }


    public function test_special_case_test_ordering_and_scores(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 23000,"area" => "1"], 'propertyType' => $uniqueType]);
        $scoreTwo = $this->createSearchProfile(["searchFields" => ["price" => [10000, 25000]], 'propertyType' => $uniqueType]);
        $scoreZero = $this->createSearchProfile(["searchFields" => ["price" => [10000, 15000]], 'propertyType' => $uniqueType]);
        $scoreThree = $this->createSearchProfile(["searchFields" => ["price" => [10000, 20000],"area" => "1"], 'propertyType' => $uniqueType]);
        $scoreOne = $this->createSearchProfile(["searchFields" => ["price" => [10000, 20000]], 'propertyType' => $uniqueType]);
        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals(count($response),3);
        $this->assertEquals($response[0]['searchProfileId'],$scoreThree->id);
        $this->assertEquals($response[0]['match_score'],3);

        $this->assertEquals($response[1]['searchProfileId'],$scoreTwo->id);
        $this->assertEquals($response[1]['match_score'],2);

        $this->assertEquals($response[2]['searchProfileId'],$scoreOne->id);
        $this->assertEquals($response[2]['match_score'],1);

    }

    public function test_special_case_test_one_field_matched(): void
    {
        // Prepare
        $uniqueType = uniqid();
        $property = $this->createProperty(["fields" => ["price" => 250000,'rooms'=>5], 'propertyType' => $uniqueType]);
        $searchProfile = $this->createSearchProfile(["searchFields" => ["price" => [null, 200000],'area'=>150], 'propertyType' => $uniqueType]);

        // Action
        $response = (new MatcherService())->match($property->id);

        // Assertion
        $this->assertEquals($response[0]['searchProfileId'] ,$searchProfile->id  );
        $this->assertEquals($response[0]['strictMatchesCount'] ,0 );
        $this->assertEquals($response[0]['looseMatchesCount'] ,1 );
    }




// Helper methods
    public function createProperty($arr)
    {
        $params = [
            "name" => "Awesome house in the middle of my town",
            "address" => "Main street 17, 10556 Riyadh",
            "propertyType" => "d44d0090-a2b5-47f7-80bb-d6e6f85fca90",
            "fields" => [
                "area" => "180",
                "yearOfConstruction" => "2010",
                "rooms" => "5",
                "heatingType" => "gas",
                "parking" => true,
                "returnActual" => "12.8",
                "price" => "1500000"
            ]
        ];
        $params = array_merge($params, $arr);
        $propertyService = (new PropertyService());
        return $propertyService->storeAndCommit($params);
    }

    public function createSearchProfile($arr)
    {
        $params = [
            "name" => "Looking for any Awesome realestate!",
            "propertyType" => "d44d0090-a2b5-47f7-80bb-d6e6f85fca90",
            "searchFields" => [
                "price" => ["0", "2000000"],
                "area" => ["150", null],
                "yearOfConstruction" => ["2010", null],
                "rooms" => ["4", null],
                "returnActual" => ["15", null]
            ]
        ];
        $params = array_merge($params, $arr);
        $searchProfileService = (new SearchProfileService());
        return $searchProfileService->storeAndCommit($params);
    }
}
