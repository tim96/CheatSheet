
# For load fixtures we will use DoctrineFixturesBundle

# Install the bundle:
# composer require --dev doctrine/doctrine-fixtures-bundle

# Enable the bundle:
# if (in_array($this->getEnvironment(), array('dev', 'test'))) {
#    $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
# }

# Add example:
# see: src/Tim/CheatSheetBundle/DataFixtures/ORM/LoadTagsData.php
# see: src/Tim/CheatSheetBundle/DataFixtures/ORM/LoadGroupsData.php - with order
# see: src/Tim/CheatSheetBundle/DataFixtures/ORM/LoadUserData.php - with container

# How to use:
# --append - Use this flag to append data instead of deleting data before loading it (deleting first is the default behavior);

php app/console doctrine:fixtures:load --append