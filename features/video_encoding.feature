@javascript @api
Feature: Video Encodings
  In order Encode videos
  As an authenticated user
  I need to be able upload a video, encode videos, select custom thumbnail, upload a thumbnail

  Scenario: Verify Video Encode module is enabled
    Given I am logged in as a user with the "administrator" role
    When I am at "admin/config"
    Then I should see "Draco video encoding"

  Scenario: Add 'Video' content type
    Given I am logged in as a user with the "administrator" role
    When I am at "/admin/structure/types"
    And I click "Add content type"
    And I fill in "Name" with "Video"
    And I wait for 2 secs
    And I fill in "Description" with "Use Video for Draco Video Encodings"
    And I press "Save and manage fields"
    Then I should see "The content type Video has been added."

  Scenario: Add fields to Video content type
    Given I am logged in as a user with the "administrator" role
    When I am at "/admin/structure/types"
    And I click 'Manage fields' in the 'Video' row
    When I add fields to the video content type
    Then I should see the added fields

  Scenario: Draco Video Encoding configuration settings
    Given I am logged in as a user with the "administrator" role
    When I am at "/admin/config/draco_video_encoding"
    And I click "Zeus Service"