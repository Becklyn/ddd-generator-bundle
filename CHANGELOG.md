2.2.0
=====
* (improvement) Command handler tests now use the CommandHandlerTestTrait instead of TransactionManagerTestTrait and DomainEventTestTrait
* (bug) Removed semicolon from the end of @covers annotations in tests
* (feature) Added givenEntityIsCreated method to entity test traits
* (improvement) Command handlers are now generated with injected entity repositories an their execute methods load an entity from the repository
* (improvement) Command handler tests are now generated with test method applicable to most common use-cases

# 2.1.0

*   (feature) Commands now ask to select correct Domain from a list

# 2.0.2

*   (bug) Fix casing bug with generated code

# 2.0.1

*   (bug) Entity test traits are now generated without one of the test methods having broken syntax

# 2.0.0

*   (bc) Upgraded library to PHP8

# 1.0.0

*   (feature) Initial release - PHP7 branch `\o/`
