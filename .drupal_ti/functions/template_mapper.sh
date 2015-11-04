#!/bin/bash

function drupal_ti_install_drupal() {
	git clone --depth 1 --branch 8.0.x http://git.drupal.org/project/drupal.git
	cd drupal
	php -d sendmail_path=$(which true) ~/.composer/vendor/bin/drush.php --yes -v site-install standard --db-url="$DRUPAL_TI_DB_URL"
	drush use $(pwd)#default
}

