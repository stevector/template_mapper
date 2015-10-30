@api
  Feature: Enable Module
    As an administrator,
    I want to verify that Template Mapper is enabled

    # @todo Figure out how to do $settings['extension_discovery_scan_tests'] = TRUE;
    # outside of settings file.

    # @todo, switch from standard install profile to testing install profile.

    Scenario: Enable Module
      Given I am logged in as a user with the "administer modules" permissions
      And I visit "/admin/modules"
      Then I check the box "edit-modules-other-template-mapper-enable"
      Then I press the "Install" button
      Then the checkbox "edit-modules-other-template-mapper-enable" should be checked

    Scenario: Enable theme
      Given the theme "template_mapper_test_theme" is enabled
      Given the theme "template_mapper_test_theme" is the active theme
