
Day 1

-Installed Laravel framework.
-1st thing was Creating the test file: Feature/MatcherTest.php. and make the first simple test 
-Implemented the "match" function in using PHP only ( no mysql )
-after finalizing each case i wrote a new case then implement the code for it
-i finished all cases and made sure they was running
Total Time Spent on Day 1: 2 hours

---------------------------------

Day 2:
-Improve performance for large datasets by transitioning filtering logic from PHP to MySQL.
-Updated the corresponding code files to utilize the new SQL queries.
-reran tests and every thing was ok
-i reread the document to make sure every thing was ok but i found that i was missing some cases 
-i rewrote missing test functions and made sure they was working 
-i made some code enhancement


-after finished i wanted to make sure i didnt miss any casee so i arrange the tests this way :

cases i have 1 search field and property has 1 field only
    cases for input
        Direct
        Range with no null on both sides
        Range with null on left side
        Range with null on right side


    cases for result to be found
        strict found
        loosely found
        not found


    one_input_one_result_direct_found
    one_input_one_result_direct_not_found
    one_input_one_result_range_no_null_found
    one_input_one_result_range_no_null_not_found
    one_input_one_result_range_null_on_left_found
    one_input_one_result_range_null_on_left_not_found
    one_input_one_result_range_null_on_right_found
    one_input_one_result_range_null_on_right_not_found
    one_input_one_result_range_no_null_loose_found
    one_input_one_result_range_null_on_left_loose_found
    one_input_one_result_range_null_on_right_loose_found

//missmatch
    missmatch_range
    missmatch_direct

//null values
    test null search
    test null price

//special cases
    test ordering and score calculation
    test At least one SearchProfile field is matching


i found that all cases are working

Total Time Spent on the 2nd Day  about 6 hours

Total Time about 8 hours 




to install 
1-run [composer install]
2-set MySQL database settings in .env file
3-run [artisan migrate --seed]  
4-run [artisan serve]
5-open url [http://127.0.0.1:8000/api/match/1] 

