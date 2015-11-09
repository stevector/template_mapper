@api
  Feature: Suggest a template
    As an administrator,
    I want to provide alternate template names.

    Scenario: No template override used for articles prior to configuring module.
      Given I am logged in as a user with the "create article content" permissions
      And I visit "node/add/article"
      And I fill in "Title" with "First Article Node"
      And I press the "Save" button
      # todo, update name
      Then I should not see the text "The file node--longform-prose.html.twig from template_mapper_test_theme"
      Then I should see the text "The file node.html.twig from template_mapper_test_theme"

    Scenario: No template override used for pages prior to configuring module.
      Given I am logged in as a user with the "create page content" permissions
      And I visit "node/add/page"
      And I fill in "Title" with "Page Node"
      And I press the "Save" button
      # todo, update name
      Then I should not see the text "The file node--marketing-message.html.twig from template_mapper_test_theme"
      Then I should see the text "The file node.html.twig from template_mapper_test_theme"


    Scenario: Configure template override for node article full
      # @todo make permissions specific to this module.
      #Given I am logged in as a user with the :permissions
      #  | permissions                   |
      #  | create article content        |
      #  | administer site configuration |

      Given I am logged in as a user with the "administrator" role
      And I go to "admin/structure/template_mapping/add"
      And I fill in "Label" with "node__article__full"
      And I fill in "Machine-readable name" with "node__article__full"
      And I fill in "Mapping" with "node__longform_prose"
      And I press the "Save" button


      Given I am logged in as a user with the "administrator" role
      And I go to "admin/structure/template_mapping/add"
      And I fill in "Label" with "node__page__full"
      And I fill in "Machine-readable name" with "node__page__full"
      And I fill in "Mapping" with "node__marketing_message"
      And I press the "Save" button

      # verify article.
      And I visit "node/add/article"
      And I fill in "Title" with "Article Node 2"
      And I press the "Save" button
      Then I should see the text "The file node--longform-prose.html.twig from template_mapper_test_theme"
      Then I should not see the text "The file node.html.twig from template_mapper_test_theme"
      # verify page.
      And I visit "node/add/page"
      And I fill in "Title" with "Page Node 2"
      And I press the "Save" button
      Then I should see the text "The file node--marketing-message.html.twig from template_mapper_test_theme"
      Then I should not see the text "The file node.html.twig from template_mapper_test_theme"



    Scenario: Delete mapping configuration
      # @todo make permissions specific to this module.
      # @todo, there is no "Then" statement here. It is just cleanup.
      Given I am logged in as a user with the "administrator" role
      And I go to "admin/structure/template_mapping"
      And I click "Delete" in the "node" row
      And I press the "Delete" button
