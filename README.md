# Matcher Case Study

## Development Log

### Day 1

- Installed Laravel framework.
- Created the test file: `Feature/MatcherTest.php` and made the first simple test.
- Implemented the "match" function using PHP only (no MySQL).
- After finalizing each case, wrote a new case and implemented the code for it.
- Finished all cases and ensured they were running.
- **Total Time Spent on Day 1:** 2 hours.

### Day 2

- Improved performance for large datasets by transitioning filtering logic from PHP to MySQL.
- Updated the corresponding code files to utilize the new SQL queries.
- Reran tests and ensured everything was working.
- Reread the document and identified missing cases.
- Rewrote missing test functions and ensured they were working.
- Made some code enhancements.

#### Test Cases Arranged:

##### Cases with 1 Search Field and 1 Property Field:

- **Cases for Input:**
  - Direct
  - Range with no null on both sides
  - Range with null on left side
  - Range with null on right side

- **Cases for Result:**
  - Strict found
  - Loosely found
  - Not found

- **Test Cases:**
  - one_input_one_result_direct_found
  - one_input_one_result_direct_not_found
  - one_input_one_result_range_no_null_found
  - one_input_one_result_range_no_null_not_found
  - one_input_one_result_range_null_on_left_found
  - one_input_one_result_range_null_on_left_not_found
  - one_input_one_result_range_null_on_right_found
  - one_input_one_result_range_null_on_right_not_found
  - one_input_one_result_range_no_null_loose_found
  - one_input_one_result_range_null_on_left_loose_found
  - one_input_one_result_range_null_on_right_loose_found

- **Missmatch Cases:**
  - missmatch_range
  - missmatch_direct

- **Null Values Cases:**
  - test null search
  - test null price

- **Special Cases:**
  - test ordering and score calculation
  - test at least one SearchProfile field is matching

Ensured all cases were working.

**Total Time Spent on Day 2:** About 6 hours.

**Total Time:** About 8 hours.

## Installation Instructions

1. Run:
    ```sh
    composer install
    ```
2. Set MySQL database settings in the `.env` file.
3. Run:
    ```sh
    php artisan migrate --seed
    ```
4. Run:
    ```sh
    php artisan serve
    ```
5. Open the URL:
    ```sh
    http://127.0.0.1:8000/api/match/1
    ```
