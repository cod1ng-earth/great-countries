Feature: Make my country great again
  In order to improve the world
  As a the leader of the greatest country in the world
  I must take actions to make my country even greater

  Background: #https://www.cdc.gov/nchs/fastats/deaths.htm
    Given There is a country called "USA" with 327167434 citizens
    And "Donald Trump" is its president
    And birth rate is 13 per 1000
    And "55" out of "10000" citizens die because of "natural reasons"
    And "4" out of "10000" citizens die because of "accidents"
    And "13" out of "100000" citizens die because of "suicide"
    And "5" out of "100000" citizens die because of "homicide"
    And "53691" new citizens arrive as "refugees"

  Scenario:
    When The president runs that country for "8" years
    Then There should me more citizens in the country than 340000000

  Scenario: restrict immigration by building a wall
    Given "100" new citizens arrive as "refugees"
    When The president runs that country for "8" years
    Then There should me more citizens in the country than 340000000



