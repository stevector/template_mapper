@api
  Feature: Suggest a template
    As an administrator,
    I want to provide alternate template names.

    Scenario: No template overridden used prior to configuring module.
      Given I am logged in as a user with the "create article content" permissions
      And I visit "node/add/article"
      And I fill in "Title" with "First Article Node"
      And print last response
      And I press the "Save" button
      # todo, update name
      Then I should not see the text "node--longform-prose.html.twig"
      Then I should see the text "node.html.twig"

#    Scenario: Configure template override for node article full
#      Given I am logged in as an admin
 #     And I go to "admin/template-mapper"
  #    And I enter the name node
   #   And I enter "node__article__full|node__longform__prose
   #   And I hit save
   #   And I create an article node
   #   Then I see node--longform-prose.twig
   #   Then I don't see node.twig
