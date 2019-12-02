# TODO Fix javascript builds in github actions before activating this feature

#@managing_catalog_promotions
#Feature: Adding a new discount with rule
#    In order to give possibility to pay less for some goods based on specific configuration
#    As an Administrator
#    I want to add a new discount with rule to the registry
#
#    Background:
#        Given the store operates on a single channel in "United States"
#        And the store classifies its products as "T-Shirts" and "Mugs"
#        And I am logged in as an administrator
#
#    @ui @javascript
#    Scenario: Adding a new discount with taxon rule
#        Given I want to create a new discount
#        When I specify its code as "HOLIDAY_SALE"
#        And I name it "Holiday sale"
#        And I add the "Product having one of taxons" rule configured with "T-Shirts" or "Mugs"
#        And I add it
#        Then I should be notified that it has been successfully created
#        And the "Holiday sale" discount should appear in the registry
#
#    @ui @javascript
#    Scenario: Adding a new discount with contains products rule
#        Given the store has a product "PHP T-Shirt" priced at "$100.00"
#        And the store has a product "PHP Mug" priced at "$100.00"
#        And I want to create a new discount
#        When I specify its code as "PHP_SPECIAL"
#        And I name it "PHP Special"
#        And I add the "Product is one of" rule configured with the "PHP T-Shirt" or "PHP Mug" product
#        And I add it
#        Then I should be notified that it has been successfully created
#        And the "PHP Special" discount should appear in the registry
#
#    @ui @javascript
#    Scenario: Adding a new discount with contains product rule
#        Given the store has a product "PHP T-Shirt" priced at "$100.00"
#        And I want to create a new discount
#        When I specify its code as "PHP_TSHIRT_SPECIAL"
#        And I name it "PHP T-Shirt discount"
#        And I add the "Product is" rule configured with the "PHP T-Shirt" product
#        And I add it
#        Then I should be notified that it has been successfully created
#        And the "PHP T-Shirt discount" discount should appear in the registry