# Configuration Management

With the launch of Drupal 8 comes a unified way of storing your site and Extension (themes, modules and plugins) configuration data. The product of the Configuration Management Initiative, the Configuration System allows for a very effecive development workflow, when leveraging tools like Drush and Git. It's not limited to developers however, the Drupal UI provides forms for managing your site's configuration too.

To get started with this material, check out this repository.

```
git clone https://github.com/DrupalizeMe/transcode_profile.git
```

Import the "drupal-8.0.0-base.sql" to a mysql database called 'drupal'.

A mysql user 'drupal', with a password of 'drupal' should be granted access to the 'drupal' database.

You can otherwise update the user, password, and database in name in your **docroot/sites/default/settings.php**

## Check out the module

You can check out the [8.x-1.x](https://github.com/DrupalizeMe/transcode_profile/tree/8.x-1.x) branch to get the complete version of this module.

```
git checkout 8.x-1.x
```

## Lessons in this series

- Drupal’s Configuration System
- Tour the Configuration System
- Drupal 8 File Structure for Configuration Sync
- How to Clone a Drupal 8 Site without the Command Line
- Clone a Drupal Site
- Synchronize Configuration with the UI
- Configuration Data Storage
- Configuration Sync Workflows
- Simple Configuration in a Module
- How to Provide Default Configuration
- Manage Configuration with Command Line Tools
- Introduction to Configuration Entities
- Save User Settings with Configuration Forms
- How to Override Configuration
- Configuration Entities Overview
- Add Properties to a Configuration Entity
- Load and Save Configuration Entity Data
- Entity Manager with a Service Container


## Versions used in this series

- Drupal 8.0.0

## Other tools used in this series

 - [Drupal Console](http://www.drupalconsole.com/)
