
Propel

./vendor/propel/propel/bin/propel sql:build --config-dir ./conf/propel
./vendor/propel/propel/bin/propel model:build --config-dir ./conf/propel
./vendor/propel/propel/bin/propel config:convert --config-dir ./conf/propel
./vendor/propel/propel/bin/propel sql:insert --config-dir ./conf/propel

