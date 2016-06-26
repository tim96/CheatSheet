
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


# You can use AlicaBundle to create a lot of test data
# https://github.com/hautelook/AliceBundle

# See: alica.yml to configuration
# See: alica_test.yml with sample

# See availalble data formats:
# https://github.com/fzaninotto/Faker#fakerprovideren_ustext

# Command to add alica fixtures:
# --append - Use this flag to append data instead of deleting data before loading it (deleting first is the default behavior);
# php app/console hautelook_alice:doctrine:fixtures:load
# php app/console h:d:f:l