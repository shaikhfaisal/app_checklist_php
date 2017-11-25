Feature: Lists

  Scenario: A newly created list should have 0 items in it
    As a user
    When I create a list called "This is going to be an empty list"
    Then I should have 0 items in the "This is going to be an empty list" list

  Scenario: Adding items to a list
    As a user
    Given I have a list called "Making chocalate-milk-dahi"
    And I add "Add one glass milk" to "Making chocalate-milk-dahi" list
    And I add "Add one teaspoon cocoa powder" to "Making chocalate-milk-dahi" list
    And I add "Add one teaspoon honey" to "Making chocalate-milk-dahi" list
    And I add "Heat in saucepan for 2 mins" to "Making chocalate-milk-dahi" list
    And I add "Pour into milk bottle" to "Making chocalate-milk-dahi" list
    And I add "Give milk bottle to Hayaa" to "Making chocalate-milk-dahi" list
    Then I should have "Add one glass milk" in the "Making chocalate-milk-dahi" list
    And I should have "Add one teaspoon cocoa powder" in the "Making chocalate-milk-dahi" list
    And I should have "Add one teaspoon honey" in the "Making chocalate-milk-dahi" list
    And I should have "Heat in saucepan for 2 mins" in the "Making chocalate-milk-dahi" list
    And I should have "Pour into milk bottle" in the "Making chocalate-milk-dahi" list
    And I should have "Give milk bottle to Hayaa" in the "Making chocalate-milk-dahi" list
    And I should have 6 items in the "Making chocalate-milk-dahi" list

  Scenario: Deleting items from a list with no items
    As a user
    Given I have a list called "A new list"
    And I remove an item "non-existent" from the "A large list" list
    Then I should have 0 items in the "A large list" list

  Scenario: Deleting items from a list
  As a user
    Given I have a list called "A large list"
    And I add "a" to "A large list" list
    And I add "b" to "A large list" list
    And I add "c" to "A large list" list
    And I add "d" to "A large list" list
    And I remove an item "c" from the "A large list" list
    Then I should have 3 items in the "A large list" list
    And I should not have "c" in the "A large list" list
